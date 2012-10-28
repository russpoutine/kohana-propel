<?php

class Task_Propel_Build extends Minion_Task
{
	
	protected function _execute(array $config)
	{
		Minion_CLI::write("Generating configuration");
		$output = $this->runGenerator('convert-conf');
		Minion_CLI::write($output);
		
		Minion_CLI::write("Generating sql");
		$output = $this->runGenerator('sql');
		Minion_CLI::write($output);
		
		Minion_CLI::write("Generating classes");
		$output = $this->runGenerator('om');
		Minion_CLI::write($output);
		
		Minion_CLI::write("Done");
	}
	
	/**
	 * Runs a specified target of propel-gen (such as convert-conf, om or sql)
	 * 
	 * @param string $target
	 * 
	 * @return string Output
	 */
	protected function runGenerator($target)
	{
		// assert there's _some_ target
		if ( empty( $target ) ) throw new \Exception("Target must be provided");

		// get path to the generator
		$propelGenPathAndFilename = PROPEL_PATH . 'generator/bin/propel-gen';
		
		// get path to application config files
		$propelConfigurationPath = APPPATH . 'config/propel';
				
		// make command
		$execWhat = sprintf(
			"%s %s %s",
			$propelGenPathAndFilename,
			$propelConfigurationPath,
			$target
		);
		
		$execOutput = '';
		ob_start();
		passthru($execWhat);
		$execOutput = ob_get_clean();
		
		return $execOutput;
	}
	
}