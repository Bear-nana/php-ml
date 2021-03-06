<?php

declare(strict_types=1);

namespace tests\Phpml\Dataset;

use Phpml\Dataset\CsvDataset;
use PHPUnit\Framework\TestCase;

class CsvDatasetTest extends TestCase
{
    /**
     * @expectedException \Phpml\Exception\FileException
     */
    public function testThrowExceptionOnMissingFile(): void
    {
        new CsvDataset('missingFile', 3);
    }

    public function testSampleCsvDatasetWithHeaderRow(): void
    {
        $filePath = dirname(__FILE__).'/Resources/dataset.csv';

        $dataset = new CsvDataset($filePath, 2, true);

        $this->assertCount(10, $dataset->getSamples());
        $this->assertCount(10, $dataset->getTargets());
    }

    public function testSampleCsvDatasetWithoutHeaderRow(): void
    {
        $filePath = dirname(__FILE__).'/Resources/dataset.csv';

        $dataset = new CsvDataset($filePath, 2, false);

        $this->assertCount(11, $dataset->getSamples());
        $this->assertCount(11, $dataset->getTargets());
    }

    public function testLongCsvDataset(): void
    {
        $filePath = dirname(__FILE__).'/Resources/longdataset.csv';

        $dataset = new CsvDataset($filePath, 1000, false);

        $this->assertCount(1000, $dataset->getSamples()[0]);
        $this->assertEquals('label', $dataset->getTargets()[0]);
    }
}
