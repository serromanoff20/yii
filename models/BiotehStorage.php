<?php namespace app\models;

class BiotehStorage
{
    private int $id;
    private int $generatedInt;

    public array $storage = [
        0=>[
            'id'=>0,
            'generated integer'=>0
        ]
    ];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id=0): void
    {
        $id++;
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getGeneratedInt(): int
    {
        return $this->generatedInt;
    }

    /**
     * @param int $generatedInt
     */
    public function setGeneratedInt(int $generatedInt): void
    {
        $this->generatedInt = $generatedInt;
    }

    protected function toSave()
    {
        if (!key_exists($this->id, $this->storage)){
            array_push($this->storage, ['id'=>$this->id, 'generated integer'=>$this->generatedInt]);

            file_put_contents("cache_file", serialize($this->storage));
        } else {
            $this->id++;

            array_push($this->storage, ['id'=>$this->id, 'generated integer'=>$this->generatedInt]);

            file_put_contents("cache_file", serialize($this->storage));
        }
        return $this->storage;
    }
}