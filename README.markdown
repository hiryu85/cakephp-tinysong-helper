# TinySong CakePHP helper

## Requirements
- CakePHP 1.3
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



# Helper methods and variables
## Variables
 - $settings  [array]  Options of helpers
     - api_key' => string 'your-api-key'

## Methods
- link(array $api_parameters, str $linkLabel, array $HtmlHelperAttributes)
- info(array $api_parameters)
