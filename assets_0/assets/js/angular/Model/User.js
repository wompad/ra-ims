function User(){

	this.firstname 			= "";
	this.middlename 		= "";
	this.lastname 			= "";
	this.province	 		= "";
	this.municipality 		= "";
	this.email_address 		= "";
	this.contact_number 	= "";
	this.is_active 			= true;
	this.office 			= "";
	this.position 			= "";

	this.bio 				= "";
	this.description 		= "";
	this.address 			= "";
	this.fb					= "";
	this.instagram 			= "";
	this.twitter 			= "";
	this.profile_pic		= "";
	this.banner 			= "";


}

User.prototype = {

	toJSON : function(){

		return{
			firstname 			: this.firstname,
			middlename 			: this.middlename,
			lastname 			: this.lastname,
			province 			: this.province.psgc_code,
			municipality 		: this.municipality.psgc_code,
			email_address 		: this.email_address,
			contact_number 		: this.contact_number,
			is_active 			: this.is_active,
			office				: this.office.id,
			position 			: this.position
		}

	},

	toJSONv2 : function(){

		return{
			firstname 			: this.firstname,
			middlename 			: this.middlename,
			lastname 			: this.lastname,
			province 			: this.province.psgc_code,
			municipality 		: this.municipality.psgc_code,
			contact_number 		: this.contact_number,
			position 			: this.position,
			address 			: this.address,
			fb 					: this.fb,
			instagram 			: this.instagram,
			twitter 			: this.twitter,
			bio	 				: this.bio,
			description 		: this.description
		}

	},

	validateEmail: function(email) {
	    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return re.test(String(email).toLowerCase());
	},

	validateNumber: function(number){
	    return number.match(/^\d{11}$/g)
	},

	invalidUserinput : function(){

		var invaliduserinput = [];

		if(this.firstname == null || this.firstname == ""){
			invaliduserinput.push("Firstname is required!");
		}
		if(this.lastname == null || this.lastname == ""){
			invaliduserinput.push("Lastname is required!");
		}
		if(this.province == null || this.province == "" || this.province.psgc_code == 0){
			invaliduserinput.push("Province is required!");
		}
		if(this.municipality == null || this.municipality == "" || this.municipality.psgc_code == 0){
			invaliduserinput.push("Municipality is required!");
		}
		if(this.office == null || this.office == "" || this.office.id == 0){
			invaliduserinput.push("Office is required!");
		}
		if(this.position == null || this.position == ""){
			invaliduserinput.push("Position is required!");
		}
		if(this.contact_number == null || this.contact_number == ""){
			invaliduserinput.push("Contact number is required!");
		}else{
			if(!this.validateNumber(this.contact_number)){
				invaliduserinput.push("Kindly input valid mobile number");
			}
		}
		if(this.email_address == null || this.email_address == ""){
			invaliduserinput.push("Email Address is required!");
		}else{
			if(!this.validateEmail(this.email_address)){
				invaliduserinput.push("Kindly input valid email address");
			}
		}
	
		return invaliduserinput;

	},

	invalidUserinputv2 : function(){

		var invaliduserinput = [];

		if(this.firstname == null || this.firstname == ""){
			invaliduserinput.push("Firstname is required!");
		}
		if(this.lastname == null || this.lastname == ""){
			invaliduserinput.push("Lastname is required!");
		}
		if(this.province == null || this.province == "" || this.province.psgc_code == 0){
			invaliduserinput.push("Province is required!");
		}
		if(this.municipality == null || this.municipality == "" || this.municipality.psgc_code == 0){
			invaliduserinput.push("Municipality is required!");
		}
		if(this.position == null || this.position == ""){
			invaliduserinput.push("Position is required!");
		}
		if(this.contact_number == null || this.contact_number == ""){
			invaliduserinput.push("Contact number is required!");
		}else{
			if(!this.validateNumber(this.contact_number)){
				invaliduserinput.push("Kindly input valid mobile number");
			}
		}
	
		return invaliduserinput;

	},

}