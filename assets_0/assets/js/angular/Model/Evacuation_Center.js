function Evacuation_Center(){

    this.id                                 = "";

    this._gps_coordinates_latitude          = "";
    this._gps_coordinates_longitude         = "";
    this._gps_coordinates_altitude          = "";
    this._gps_coordinates_precision         = "";

    this.name_of_evacuation_center          = "";
    this.type_of_building                   = "";
    this.availability_status                = "";
    this.building_status                    = "";
    this.floor_area                         = "";
    this.capacity_family                    = "";
    this.capacity_individuals               = "";
    this.no_of_rooms                        = "";
    this.ffps_storage_availability          = "";
    this.material_recycling_facility        = "";
    this.compost_pit_latrine                = "";
    this.sealed_latrines                    = "";
    this.female_cr                          = "";
    this.male_cr                            = "";
    this.common_cr                          = "";
    this.name_of_designated_camp_manager    = "";
    this.source_of_potable_water            = "";
    this.source_of_non_potable_water        = "";
    this.child_friendly_spaces              = "";
    this.women_friendly_spaces              = "";
    this.couples_room                       = "";
    this.prayer_room                        = "";
    this.community_kitchen                  = "";
    this.availability_of_wash_facilities    = "";
    this.ramp_for_pwds                      = "";
    this.help_desk                          = "";
    this.info_boards                        = "";
    this.has_cccm_committee                 = "";
    this.number_trained_cccm                = "";
    this.number_trained_cfs                 = "";
    this.number_trained_wfs                 = "";
    this.date_last_updated                  = "";

}

Evacuation_Center.prototype = {

    toJSON : function(){

        return {
            name_of_evacuation_center       :  this.name_of_evacuation_center,
            _gps_coordinates_latitude       : this._gps_coordinates_latitude,
            _gps_coordinates_longitude      : this._gps_coordinates_longitude,
            _gps_coordinates_altitude       : this._gps_coordinates_altitude,
            _gps_coordinates_precision      : this._gps_coordinates_precision,
            type_of_building                :  this.type_of_building.lib_name,
            availability_status             :  this.availability_status.lib_name,
            building_status                 :  this.building_status.lib_name,
            floor_area                      :  this.floor_area,
            capacity_family                 :  this.capacity_family,
            capacity_individuals            :  this.capacity_individuals,
            no_of_rooms                     :  this.no_of_rooms,
            ffps_storage_availability       :  this.ffps_storage_availability,
            material_recycling_facility     :  this.material_recycling_facility,
            compost_pit_latrine             :  this.compost_pit_latrine,
            sealed_latrines                 :  this.sealed_latrines,
            female_cr                       :  this.female_cr,
            male_cr                         :  this.male_cr,
            common_cr                       :  this.common_cr,
            name_of_designated_camp_manager :  this.name_of_designated_camp_manager,
            source_of_potable_water         :  (this.source_of_potable_water.id == 0 ? null : this.source_of_potable_water.lib_name),
            source_of_non_potable_water     :  (this.source_of_non_potable_water.id == "0" ? null : this.source_of_non_potable_water.lib_name),
            child_friendly_spaces           :  this.child_friendly_spaces,
            women_friendly_spaces           :  this.women_friendly_spaces,
            couples_room                    :  this.couples_room,
            prayer_room                     :  this.prayer_room,
            community_kitchen               :  this.community_kitchen,
            availability_of_wash_facilities :  this.availability_of_wash_facilities,
            ramp_for_pwds                   :  this.ramp_for_pwds,
            help_desk                       :  this.help_desk,
            info_boards                     :  this.info_boards,
            has_cccm_committee              :  this.has_cccm_committee,
            number_trained_cccm             :  this.number_trained_cccm,
            number_trained_cfs              :  this.number_trained_cfs,
            number_trained_wfs              :  this.number_trained_wfs,
            date_last_updated               :  this.date_last_updated
        }

    },

}