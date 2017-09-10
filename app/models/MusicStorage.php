<?php
//namespace App\Models;

class MusicStorage extends \Phalcon\Mvc\Model
{

    const YANDEX_SOURCE = 'yandex';
    const VK_SOURCE = 'vk';


    const LIMIT_MUSIC_FROM_SOURCE = 3;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=250, nullable=true)
     */
    public $title;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $link;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $source_type;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("phalcon");
        $this->setSource("music_storage");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'music_storage';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MusicStorage[]|MusicStorage|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MusicStorage|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
