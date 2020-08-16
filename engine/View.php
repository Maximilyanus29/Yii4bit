<?php 

namespace app\engine;
/**
 * 
 */
class View
{
	private $css;
	private $js;
	
	function __construct($layout,$controllerId,$params=[],$view)
	{
		$pathToView='../view/'.$controllerId.'/'.$view.'.php';

		// var_dump($pathToView);


		



		if (file_exists($pathToView)) {

			
            $content = $this->renderPhpFile($pathToView,$params);

			$layout = require ('../view/'.$layout.'.php');



		}

	}





	public function renderPhpFile($_file_, $_params_ = [])
    {
        $_obInitialLevel_ = ob_get_level();
        ob_start();
        ob_implicit_flush(false);
        extract($_params_, EXTR_OVERWRITE);
        try {
            require $_file_;
            return ob_get_clean();
        } catch (\Exception $e) {
            while (ob_get_level() > $_obInitialLevel_) {
                if (!@ob_end_clean()) {
                    ob_clean();
                }
            }
            throw $e;
        } catch (\Throwable $e) {
            while (ob_get_level() > $_obInitialLevel_) {
                if (!@ob_end_clean()) {
                    ob_clean();
                }
            }
            throw $e;
        }
    }
}




 ?>