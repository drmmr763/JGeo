# Joomla Geolocator Plugin

Created for a client of mine. Uses HTML5 geolocation first, and then backs up to IP Address based geolocation.

Uses geoposition.js: https://github.com/estebanav/javascript-mobile-desktop-geolocation

# Access Data Via JSession

Once geo data is found, it gets stored in JSession. This makes it accessible to any other component that wants to access it in Joomla. 

## Getting User Position
```
$session = JFactory::getSession();

// check that the plugin has set the position
if ($session->get('jgeo_position_status', false)) {
    // assuming we have the position available, you can access the json object
    // the object will be an empty array if it hasn't been set as well
    $position = json_decode($session->get('jgeo_position'));
    var_dump($position);
}
```