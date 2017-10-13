<?php

class AppError extends ErrorHandler {

	public function _outputMessage($template='error') {
	
        // Render the template
        $this->controller->beforeFilter();
		$this->controller->render($template);
		$this->controller->afterFilter();
		
		// Output the rendered template
		echo $this->controller->output;

	}

}