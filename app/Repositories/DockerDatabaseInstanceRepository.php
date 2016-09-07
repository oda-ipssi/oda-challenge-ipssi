<?php
namespace App\Repositories;


/**
 * Class DockerDatabaseInstanceRepository
 */
class DockerDatabaseInstanceRepository
{

    /** @var array
     * This mock will be soon replaced by a real table from docker instance
     */
    private $databaseInstanceMock = [
        [
            'id' => 1,
            'name' => 'Climbing shop database',
            'created_at' => '02/02/2016',
            'user_id' => 2
        ],
        [
            'id' => 2,
            'name' => 'Surf shop database',
            'created_at' => '08/12/2015',
            'user_id' => 2
        ],
        [
            'id' => 3,
            'name' => 'Hiking shop database',
            'created_at' => '01/01/2012',
            'user_id' => 3
        ],

    ];

    /**
     * @return int
     */
    public function getDatabasesNumber() {

        return count($this->databaseInstanceMock);
    }

}