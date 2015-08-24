/*
 * Author Chad Windnagle
 * @Package plg_jgeo
 * @Repo: https://github.com/drmmr763/JGeo
 */

var JGeo = {

    base: '',

    init: function() {
        if (geoPosition.init()) {
            geoPosition.getCurrentPosition(
                this.success_callback,
                this.error_callback,
                {
                    enableHighAccuracy:true
                }
            );
        } else {
            this.fallback();
        }
    },

    fallback: function() {
        console.log('fallback');
    },

    success_callback: function(p) {
        console.log(p);
        JGeo.registerSessionLocation(p.coords.latitude, p.coords.longitude);

        console.log();
    },

    error_callback: function(p) {
        console.log(p);
    },

    /*
     * Register the location via ajax interface
     */
    registerSessionLocation: function(latitude, longitude)
    {
        jQuery.ajax({
            url: this.getBase(),
            format: 'json',
            data: {
                    option: 'com_ajax',
                    plugin: 'jgeo',
                    format: 'json',
                    group: 'system',
                    latitude: latitude,
                    longitude: longitude
                  }
        }).success(function(data){
            console.log(data);
        }).error(function(xhr, textStatus, errorThrown){
            console.log(xhr);
        }).always(function() {

        });
    },

    /*
     * Set the base url parameter
     *
     * @param base the base url
     * @return this
     */
    setBase: function(base)
    {
        this.base = base;
        return this;
    },

    /*
     * Get the base url
     *
     * @return string
     */
    getBase: function() {
        return this.base;
    }
};