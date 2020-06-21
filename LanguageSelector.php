<?php
namespace common\components;
use yii\base\BootstrapInterface;

class LanguageSelector implements BootstrapInterface
{
    public $supportedLanguages = [];

    public function bootstrap($app)
    {
        $this->supportedLanguages = array_keys($app->params['languages']);
        $preferredLanguage = isset($app->request->cookies['language']) ? (string)$app->request->cookies['language'] : null;
    
        // or in case of database:
        // $preferredLanguage = $app->user->language;

        if (empty($preferredLanguage)) {
            $preferredLanguage = $app->request->getPreferredLanguage($this->supportedLanguages);
        }
        self::setLanguage($preferredLanguage);
        //$app->urlManager->rules[1]->defaults['lang'] = $preferredLanguage;
        $app->urlManager->rules[1]->defaults['lang'] = $preferredLanguage;
         \Yii::$app->language = 'de';
    }
    // get language value according to key 
    public static function getLanguageLocale($language){
     
        $lang_array=\Yii::$app->params['languages'];
        if(!empty($lang_array[$language])){
            return $lang_array[$language];
        }else{
            return  $lang_array['de'];
        }
    }  
    
    //get key according to value
    public static function getLocaleLanguage($locale){
        $lang_array=\Yii::$app->params['languages'];
         if(array_search($locale,$lang_array)){
             return array_search($locale,$lang_array);
         }else{
            return  $lang_array['de'];
         }
    
    }  

    public function setLanguage($language){
        \Yii::$app->language = self::getLanguageLocale($language);
    }
}

?>