<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PropertiesFixture
 */
class PropertiesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'location' => 'Lorem ipsum dolor sit amet',
                'price' => 1.5,
                'bedrooms' => 1,
                'bathrooms' => 1,
            ],
        ];
        parent::init();
    }
}
