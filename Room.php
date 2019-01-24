<?php
/**
 * Created by PhpStorm.
 * User: Kobby
 * Date: 4/16/2018
 * Time: 6:45 PM
 */

class Room
{

    public $roomId;
    public $bedCountCurrent;

    public function __construct($id, $bedCount)
    {
        $this->setBedCountCurrent($bedCount);
        $this->setRoomId($id);
    }

    /**
     * @param mixed $bedCountCurrent
     */
    public function setBedCountCurrent($bedCountCurrent)
    {
        $this->bedCountCurrent = $bedCountCurrent;
    }

    /**
     * @return mixed
     */
    public function getBedCountCurrent()
    {
        return $this->bedCountCurrent;
    }

    /**
     * @return mixed
     */
    public function getRoomId()
    {
        return $this->roomId;
    }

    /**
     * @param mixed $roomId
     */
    public function setRoomId($roomId)
    {
        $this->roomId = $roomId;
    }

    /**
     * @return mixed
     */



}