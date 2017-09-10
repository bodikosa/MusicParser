<?php
use Phalcon\Cli\Task;

class ParseTask extends Task
{
    /**
     * @param array $params
     * $params[0] - text song for parse
     * Next elements $params are sources for parse music
     * These method can parse several sources
     */
    public function ParseSourceAction(array $params)
    {
        $findText = array_shift($params);

        foreach ($params as $actionName) {
            $this->console->handle(
                [
                    "task"   => "parse",
                    "action" => $actionName,
                    "params" => array($findText)
                ]
            );
        }

    }

    /**
     * @param array $params
     * Method for parse Yandex music
     */
    public function YandexAction(array $params)
    {

        $textMusic = $params[0];
        $html =  file_get_contents("https://music.yandex.ru/search?text={$textMusic}&type=tracks");

        $classname = 'button button_round button_transparent share not-handled  button_ico';
        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();
        $xpath = new DOMXPath($dom);
        $musicLinksResult = $xpath->query("//*[contains(@class, '$classname')]");

        foreach ($musicLinksResult as $countValue => $musicLink) {
            if($countValue < MusicStorage::LIMIT_MUSIC_FROM_SOURCE) {
                $musicLink = $musicLink->getAttribute("href");
                $this->SaveTrackToDb("Руукки Верх", $musicLink, MusicStorage::YANDEX_SOURCE);
            } else{
                break;
            }
        }
    }

    /**
     * @param array $params
     * Method for parse VK music
     */
    public function VkAction(array $params)
    {
       //release vk parse
    }

    private function SaveTrackToDb ($title, $link, $source_type) {

        $musicStore = new MusicStorage();

        return $musicStore->save(
            [
                'title' => $title,
                'link' =>  $link,
                'source_type' => $source_type,
            ]
        );
    }
}