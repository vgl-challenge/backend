<?php declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';


class DataPersistanceTest extends \PHPUnit\Framework\TestCase
{
    private $persistanceManager;

    protected function setUp() : void
    {
        $this->persistanceManager = new \App\Manager\DataPersistanceManager(
            new \App\Storage\Reader,
            new \App\Storage\Writer
        );
    }

    protected function tearDown() : void
    {
        try {
            $this->persistanceManager->delete("somefilethatdoesntexist");
        } catch (\Exception $e) {}

        try {
            $this->persistanceManager->delete("someotherfile");
        } catch (\Exception $e) {}

        $this->persistanceManager = null;
    }

    public function testCannotUpdateFile()
    {
        $this->expectException(\App\Storage\Exception\FileDoesntExistException::class);
        $this->persistanceManager->update("somefilethatdoesntexist", "id", "name", "price");
    }

    public function testCannotCreateFile()
    {
        $this->expectException(\App\Storage\Exception\FileExistsException::class);
        $this->persistanceManager->create("someotherfile", "id", "name", "price");
        $this->persistanceManager->create("someotherfile", "id", "name", "price");
    }

}
