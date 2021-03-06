<?php

class SeleniumTestListener implements PHPUnit_Framework_TestListener {
	private $logger;
	private $tests_ok = 0;
	private $tests_failed = 0;

	public function __construct( $loggerInstance ) {
		$this->logger = $loggerInstance;
	}

	public function addError( PHPUnit_Framework_Test $test, Exception $e, $time ) {
		$this->logger->write( 'Error: ' . $e->getMessage() );
		$this->tests_failed++;
	}

	public function addFailure( PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time ) {
		$this->logger->write( 'Failed: ' . $e->getMessage() );
		$this->tests_failed++;
	}

	public function addIncompleteTest( PHPUnit_Framework_Test $test, Exception $e, $time ) {
		$this->logger->write( 'Incomplete.' );
		$this->tests_failed++;
	}

	public function addSkippedTest( PHPUnit_Framework_Test $test, Exception $e, $time ) {
		$this->logger->write( 'Skipped.' );
		$this->tests_failed++;
	}

	public function startTest( PHPUnit_Framework_Test $test ) {
		$this->logger->write(
			'Testing ' . $test->getName() . ' ... ',
			SeleniumTestSuite::CONTINUE_LINE
		);
	}

	public function endTest( PHPUnit_Framework_Test $test, $time ) {
		if ( !$test->hasFailed() ) {
			$this->logger->write( 'OK', SeleniumTestSuite::RESULT_OK );
			$this->tests_ok++;
		}
	}

	public function startTestSuite( PHPUnit_Framework_TestSuite $suite ) {
		$this->logger->write( 'Testsuite ' . $suite->getName() . ' started.' );
		$this->tests_ok = 0;
		$this->tests_failed = 0;
	}

	public function endTestSuite( PHPUnit_Framework_TestSuite $suite ) {
		$this->logger->write( 'Testsuite ' . $suite->getName() . ' ended.' );
		if ( $this->tests_ok > 0 || $this->tests_failed > 0 ) {
			$this->logger->write( ' OK: ' . $this->tests_ok . ' Failed: ' . $this->tests_failed );
		}
		$this->tests_ok = 0;
		$this->tests_failed = 0;
	}

	public function statusMessage( $message ) {
		$this->logger->write( $message );
	}
}

