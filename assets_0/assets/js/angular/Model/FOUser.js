function FOUser(){

	this.account_number 	= "";
	this.area_of_assignment = "";
	this.birthdate 			= "";
	this.contact 			= "";
	this.division 			= "";
	this.employee_id 		= "";
	this.first_name 		= "";
	this.gender 			= "";
	this.id_number 			= "";
	this.image_path 		= "";
	this.last_name 			= "";
	this.middle_name 		= "";
	this.position 			= "";
	this.section 			= "";
	this.status 			= "";
	this.username 			= "";
	this.email_address 		= "";
	this.password 			= "";
	this.confirmpassword	= "";

	this.bio 				= "";
	this.description 		= "";
	this.address 			= "";
	this.fb					= "";
	this.instagram 			= "";
	this.twitter 			= "";
	this.profile_pic		= "";
	this.banner 			= "";

}

FOUser.prototype = {

	toJSON : function(){

		return {
			account_number 			: this.account_number,
			area_of_assignment 		: this.area_of_assignment,
			birthdate			 	: this.birthdate,
			contact 				: this.contact,
			division 				: this.division,
			employee_id 			: this.employee_id,
			first_name 				: this.first_name,
			gender 					: this.gender,
			id_number 				: this.id_number,
			image_path 				: this.image_path,
			last_name 				: this.last_name,
			middle_name 			: this.middle_name,
			position 				: this.position,
			section 				: this.section,
			status 					: this.status,
			username 				: this.username,
			email_address 			: this.email_address,
			password				: this.password
		}

	},

	toJSONv2 : function(){

		return {
			user_bio 				: this.bio,
			user_description 		: this.description,
			user_address 			: this.address,
			user_fb 				: this.fb,
			user_instagram 			: this.instagram,
			user_twitter 			: this.twitter
		}

	},

	validateEmail: function(email) {
	    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return re.test(String(email).toLowerCase());
	},

	validatePassword: function(password) {
		var regularExpression = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
	    var valid = regularExpression.test(password);
	    return valid;
	},

	validateNumber: function(number){
	    return number.match(/^\d{11}$/g)
	},

	invalidUserinput : function(){

		var invaliduserinput = [];

		if(this.contact == null || this.contact == ""){
			invaliduserinput.push("Contact number is required!");
		}else{
			if(!this.validateNumber(this.contact)){
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
		if((typeof this.password === 'undefined' || this.password === null || this.password === "") || (typeof this.confirmpassword === 'undefined' || this.confirmpassword === null || this.confirmpassword === "")){
			invaliduserinput.push("Kindly input password and confirm password");
		}else{
			if(this.password === this.confirmpassword){
				if(!this.validatePassword(this.password)){
					invaliduserinput.push("Password must be [8 characters long], [one uppercase letter], [one lowercase letter], [one number], and [one special character].");
				}
			}else{
				invaliduserinput.push("Password and confirm password does not matched.");
			}
		}
	
		return invaliduserinput;

	},

}