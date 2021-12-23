<?php
namespace Omnipro\ModuloCsv\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\Bootstrap;
class CustomCommand extends Command
{
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('cron:comando');
        $this->setDescription('This is my command.');

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return null|int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {   
        $bootstrap = Bootstrap::create(BP, $_SERVER);
        $objectManager = $bootstrap->getObjectManager();
        $state = $objectManager->get('Magento\Framework\App\State');
        $state->setAreaCode('frontend');
        $dir = "/var/www/html/var/import/croncsv.csv";
        $file = fopen($dir, 'r'); // set path to the CSV file
        $cont = 0;
        if ($file !== false) {
            $output->writeln("reading file");
            
            
            // used for updating product stock - and it's important that it's inside the while loop
            $stockRegistry = $objectManager->get('Magento\CatalogInventory\Api\StockRegistryInterface');                
            $header = fgetcsv($file); // get data headers and skip 1st row
            
            // enter the min number of data fields you require that the new product will have (only if you want to standardize the import)
            $required_data_fields = 3;
                
            while ($row = fgetcsv($file, 1000, ",")) {
                $data_count = count($row);
                if ($data_count < 1) {
                    continue;
                }
                
                // used for setting the new product data
                $product = $objectManager->create('Magento\Catalog\Model\Product');
                $data = array();
                $data = array_combine($header, $row);

                $output->writeln($data['sku']);
                // $output->writeln($data['price']);

                $sku = $data['sku'];
                if ($data_count < $required_data_fields) {
                    $output->writeln("Skipping product sku " . $sku . ", not all required fields are present to create the product.");
                    continue;
                }
        
                $name = $data['name'];                
                $price = trim($data['price']);
                $specialprice = trim($data['specialprice']);
                $startdate = $data['fechainicio'];
                $enddate = $data['fechafinalizacion'];
                $qty = trim($data['qty']);
                $urlkey = $data['urlkey'];

                if($price <= $specialprice || $sku == null || $price == null || $qty == null || $qty == 0){
                    $output->write('Se Inserto una cantidad de ');
                    $output->write($cont);
                    $output->writeln(' Productos');
                    return $output->writeln('No se pudo insertar el producto');
                }else if ($specialprice != null && $startdate == null){
                    $output->write('Se Inserto una cantidad de ');
                    $output->write($cont);
                    $output->writeln(' Productos');
                    return $output->writeln('No se pudo insertar el producto');
                }else if ($urlkey == null){
                    $urlkey = $name . $sku;
                    $output->writeln($urlkey);

                }
                
                
                $output->writeln($cont);

                try {
                    $product->setTypeId('simple') // type of product you're importing
                     ->setStatus(1) // 1 = enabled
                        ->setAttributeSetId(4) // In Magento 2.2 attribute set id 4 is the Default attribute set (this may vary in other versions)
                        ->setName($name)
                        ->setSku($sku)
                        ->setPrice($price)
                        ->setStartDate($startdate)
                        ->setEndDate($enddate)
                        ->setTaxClassId(0) // 0 = None
                        ->setCategoryIds(array(2, 3)) // array of category IDs, 2 = Default Category
                        ->setSpecialPrice($specialprice)
                        //->setUrlKey($url_key) // you don't need to set it, because Magento does this by default, but you can if you need to
                        ->setUrlKey($urlkey) // you don't need to set it, because Magento does this by default, but you can if you need to
                        ->setWebsiteIds(array(1)) // Default Website ID
                        ->setStoreId(0) // Default store ID
                        ->setVisibility(4) // 4 = Catalog & Search
                        ->save();
                        $output->writeln('entro');                        
                        $cont = $cont+1;

                } catch (\Exception $e) {
                    $output->writeln('Error importing product sku: '.$sku.'. '.$e->getMessage());
                    continue;
                }                
                try {
                    $stockItem = $stockRegistry->getStockItemBySku($sku);
            
                    if ($stockItem->getQty() != $qty) {
                        $stockItem->setQty($qty);
                        if ($qty > 0) {
                            $stockItem->setIsInStock(1);
                        }
                        $stockRegistry->updateStockItemBySku($sku, $stockItem);
                    }
                } catch (\Exception $e) {
                    $output->writeln('Error importing stock for product sku: '.$sku.'. '.$e->getMessage());
                    continue;
                }
                unset($product);

            }
            
            fclose($file);
            $output->write('Se Inserto una cantidad de ');
            $output->write($cont);
            $output->writeln(' Productos');
            
        }       
    }
    
}