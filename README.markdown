 TinySong CakePHP helper
==========================

## Requirements
- CakePHP 2
- API key [tinysong.com](http://www.tinysong.com/api)

## Installation
- Move to your plugins path: *cd myappdir/app*
- Download code with:
  - Git Clone = *git clone url plugins/tiny_song*
  - Git Submodule = *git submodule add url plugins/tiny_song*
  - Manual = Download zip files from "code" section and extract to *plugins/tiny_song* path


## Usage
- Import TinySong helper in your controller *var $helpers = array([...], 'TinySong.TinySong')* _OR_ include in your action with *$this->helpers[] = 'TinySong.TinySong'*
- Use it on your view $this->TinySong->methods() [See helper methods](#)


    #### How i can set Api key?
    For setup the api key you can use two ways.
    * Setting api key from controller/action
      * ```$this->helpers['TinySong.TinySong'] = array('api_key' => 'MY-API-KEY')```
      * ```var $helpers = array([...], 'TinySong.TinySong' => array('api_key' => 'MY-API-KEY'))```

    * Setting api key from helper (valid only or the current request)
    ```
    $this->TinySong->link(array( 'title' => 'Symboli', 'api_key' => 'MY-API-KEY'))
    ```

# Helper methods and variables
### Variables
 - $settings  [array]  Helper Options:
   - api_key => 'YOUR-API-KEY' (String)

### Methods
- **link(array $api_parameters, str $linkLabel, array $HtmlHelperAttributes)**

    *Return a string with <a/> element for listening the track*
   
    *Parameters*
      1. $api\_parameters can contains:
         * api\_key => 'API_KEY' *Change the api key for this request only*
         * artist => 'Artist name' *Not required*
         * album =>  'Album name'  *Not required*
         * **title** => 'Track name'  **REQUIRED VALUE**
      2. $linkLabel => 'Line name'  *Text label of link*
      3. $HtmlHelperAttributes => array(...)   *See HtmlHelper::link supported attributes*
    

- info(array $api_parameters)

   *Return json with all track metas or null if the track is not present on Grooveshark.com*

   *Parameters*
     * See link methods api_parameters information
