<?
// Products controller
class ProductsController extends AppController {
    // Setup the controller
    var $name       = 'Products';
    var $uses       = array('ClassesModel', 'SubclassesModel', 'FormatsModel', 'PricesModel', 'FinishingModel');
    var $helpers    = array('Asset', 'Html', 'Javascript', 'Ajax', 'Form', 'Ogone', 'User', 'Generic');
    var $components = array('RequestHandler', 'Session');
    
    // Default page
    public function showClass($slug) {
        $slug  = $this->params['slug'];
        $class = $this->ClassesModel->findProduct($slug);

        $this->pageTitle = $class['naam'];

        $this->set('class', $class);
        $this->set('noTitle', true);
        $this->set('noService', true);
        $this->set('shopSidebar', true);
        $this->set('bannerPage', false);

        $this->set('page','products');
    }
    
    // Banner page
    public function showClassBanner($slug) {
        $slug  = $this->params['slug'];
        $class = $this->ClassesModel->findProduct($slug);

        $this->pageTitle = $class['naam'];
        $this->set('class', $class);
        $this->set('noTitle', true);
        $this->set('noService', true);
        $this->set('shopSidebar', true);
        $this->set('bannerPage', true);
        
        $this->set('page','products');
    }
    
    // Show a subclass
    public function showSubClass() { 

        Configure::write('debug', 0);
        if ($this->RequestHandler->isAjax()) {
            
            $classId    = $this->params['url']['id'];
            
            $subclasses = $this->SubclassesModel->find($classId);
            
            if ($subclasses == false) {
                die('<br><br>Deze productcategorie is nog niet aangemaakt op de server.');
            }
            
            $this->set('subclasses', $subclasses);
            
            
            // Save the current class in the session
            if (!isset($_SESSION['Order'])) {
                $_SESSION['Order'] = array();
            }
            $_SESSION['Order']['class'] = $classId;
            
        }
    }
    
    
    
    // Show a subclassBanner
    public function showFormatsBanner() { 

        // Only submitted via ajax
        Configure::write('debug', 0);
        if ($this->RequestHandler->isAjax()) {
            
            // Get the details from the form
            $subclassId = $this->params['url']['id'];
            $subclass   = $this->SubclassesModel->findOne($subclassId);
            
            // Get the list of formats
            $formats = $this->FormatsModel->find($subclassId);
            
       
            $format = '';
            
            foreach ($formats as $currentFormat)
            {
                if($currentFormat["naam"] == 'A')
                {
                    $format = $currentFormat;
                }
            }
            
            $this->set('format', $format);
            
            
            // Save the current subclass in the session
            $_SESSION['Order']['class']       = $subclass['_k2_classid'];
            $_SESSION['Order']['subclass']    = $subclassId;
            $_SESSION['Order']['grammage']    = $subclass['grammage'];
            $_SESSION['Order']['productnaam'] = $formats[0]['formaat_naam_uc'];
            $_SESSION['Order']['Specs']       = $formats[0]['web_formats_subclasses::beschrijving_css_c'];

        }
    }
    
    // Show the formats
    public function showFormats() {
        
        // Only submitted via ajax
        Configure::write('debug', 0);
        if ($this->RequestHandler->isAjax()) {
            
            // Get the details from the form
            $subclassId = $this->params['url']['id'];
            $subclass   = $this->SubclassesModel->findOne($subclassId);

            // Get the list of formats
            $formats = $this->FormatsModel->find($subclassId);
            


            // Check the result of the subclasses
            if ($formats == false) {
                die('<br><br>Er werden geen producten gevonden');
            }

            // Add them to the template
            $this->set('formats', $formats);
            
            
            // Save the current subclass in the session
            $_SESSION['Order']['class']       = $subclass['_k2_classid'];
            $_SESSION['Order']['subclass']    = $subclassId;
            $_SESSION['Order']['grammage']    = $subclass['grammage'];
            $_SESSION['Order']['productnaam'] = $formats[0]['formaat_naam_uc'];
            $_SESSION['Order']['Specs']       = $formats[0]['web_formats_subclasses::beschrijving_css_c'];

        }
        
    }
    
    
    // Show the list of prices
    public function showPrices() {

        // Only submitted via ajax
        Configure::write('debug', 0);
        if ($this->RequestHandler->isAjax()) {

            // Get the details from the form
            $formaatid = $this->params['url']['id'];
            $naam      = $this->params['url']['name'];
            $subclassid = $this->params['url']['subclassid'];

            // Get subclass delivery info
            $deliveryinfo = $this->SubclassesModel->getDeliveryInfo($subclassid);

            // Get the list of finishing options
            $prices = $this->PricesModel->find($formaatid);

            // Check the result of the subclasses
            if ($prices == false) {
                die('<br><br>Er werden geen prijzen gevonden');
            }
            
            // Add them to the template
            $this->set('prices', $prices);
            $this->set('deliveryinfo', $deliveryinfo);
            $_SESSION['Order']['productnaam'] = $naam;
        
        }
        
    }
    
    // Show the list of prices Banner
    public function showPricesBanner() {

        // Only submitted via ajax
        Configure::write('debug', 0);
        if ($this->RequestHandler->isAjax()) {
            
            // Get the details from the form
            $formaatid = $this->params['url']['id'];
            $naam      = $this->params['url']['name'];
            $formatb = $this->params['url']['formatb'];
            $formath = $this->params['url']['formath'];
            
            // Get the list of finishing options
            $prices = $this->PricesModel->find($formaatid);
            
            

            // Check the result of the subclasses
            if ($prices == false) {
                die('<br><br>Er werden geen prijzen gevonden');
            }
            
            // Add them to the template
            $this->set('prices', $prices);
            $_SESSION['Order']['productnaam'] = $naam;
            $_SESSION['Order']['formatBannerB'] = $formatb;
            $_SESSION['Order']['formatBannerH'] = $formath;
            

        }
        
    }
    
    // Show the finishing
    public function showFinishing() {
        
        // Only submitted via ajax
        if ($this->RequestHandler->isAjax()) {
            // Get the details from the form
            $prijsid = $this->params['url']['id'];
            
            // Get the list of finishing options
            $finishing = $this->FinishingModel->find($prijsid);
            // Check the result of the subclasses
            if ($finishing == false) {
                die('');
            }
        
            // Add them to the template
            $this->set('finishing', $finishing);
        }

    }
    
}