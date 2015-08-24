# Joomla Geolocator Plugin

Created for a client of mine. Uses HTML5 geolocation first, and then backs up to IP Address based geolocation.

Uses geoposition.js: https://github.com/estebanav/javascript-mobile-desktop-geolocation

With fallback provided by Telize: http://www.telize.com/

# Access Data Via JSession

Once geo data is found, it gets stored in JSession. This makes it accessible to any other component that wants to access it in Joomla. 
