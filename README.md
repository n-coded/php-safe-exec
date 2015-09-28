# PHP-safe-exec
Generate and run shell command safely by escaping option value and argument

### Usage:
    $command = new SafeExec('unoconv');
    $command->addOption('-f', 'pdf');
    $command->addOption('-o', 'test.pdf');
    $command->addArgument('test.docx');
    $command->stdoutToNull();
    $command->shell_exec();

or use chaining:

    $command = (new SafeExec('unoconv'))->addOption('-f', 'pdf')->addOption('-o', 'test.pdf')->addArgument('test.docx')->stderrToStdout();
    $command->exec($output, $return_var);

#### Donation
Thank you for using and donation <http://goo.gl/xdEcN6>
