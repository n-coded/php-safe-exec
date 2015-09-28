<?php namespace Ncoded\SafeExec;

class SafeExec {
	protected $command;
	protected $workingDirectory;
	
	function __construct($command) {
		$this->setCommand($command);
	}
	
	protected function setCommand($command) {
		$this->command = escapeshellcmd($command);
		return $this;
	}
	
	public function setWorkingDirectory($path) {
		$this->workingDirectory = $path;
		return $this;
	}
	
	public function addOption($option, $value = null, $separator = ' ') {
		$this->command .= ' ' . $option;
		if (!is_null($value)) {
			$this->command .= $separator . escapeshellarg($value);
		}
		return $this;
	}
	
	public function addArgument($argument) {
		$this->command .= ' ' . escapeshellarg($argument);
		return $this;
	}
	
	public function outputTo($file) {
		$this->command .= ' > ' . escapeshellarg($file);
		return $this;
	}
	
	public function errorTo($file) {
		$this->command .= ' 2> ' . escapeshellarg($file);
		return $this;
	}
	
	public function stdoutToNull() {
		$this->command .= ' > /dev/null';
		return $this;
	}
	
	public function stderrToNull() {
		$this->command .= ' 2> /dev/null';
		return $this;
	}
	
	public function stderrToStdout() {
		$this->command .= ' 2>&1';
		return $this;
	}
	
	protected function getFullCommand() {
		return (is_null($this->workingDirectory) ? '' : 'cd ' . escapeshellarg($this->workingDirectory) . ' && ') . $this->command;
	}
	
	public function exec(&$output = null, &$return_var = null) {
		return exec($this->getFullCommand(), $output, $return_var);
	}
	
	public function shell_exec() {
		return shell_exec($this->getFullCommand());
	}
	
	public function system(&$return_var = null) {
		return system($this->getFullCommand(), $return_var);
	}
	
	public function passthru(&$return_value = null) {
		return passthru($this->getFullCommand(), $return_value);
	}
	
}
