function Shopping_Cart(){

	this.items_list 		= [];

	this.subject 			= "";
	this.incident_name 		= "";
	this.incident_date 		= "";
	this.estimated_family 	= ""

	this.dromic_file 		= "";
	this.request_file 		= "";

}

Shopping_Cart.prototype = {

	toJSON : function(){

		return{
			items_list 			: this.items_list,
			subject 			: this.subject,
			incident_name 		: this.incident_name,
			incident_date 		: this.incident_date,
			estimated_family 	: this.estimated_family,
			dromic_file 		: this.dromic_file,
			request_file 		: this.request_file
		}

	},

	toNull: function(){

		return{
			items_list 			: [],
			subject 			: "",
			incident_name 		: "",
			incident_date 		: "",
			estimated_family 	: "",
			dromic_file 		: "",
			request_file 		: ""
		}

	},

	addItems : function(){

		var id = this.items_list.length + 1;

		this.items_list.push({
			id 						: id,
			item_requested 			: "",
			quantity_requested		: 0,
			check 					: false
		})

	},

	removeItem : function(x){

        this.items_list.splice(x, 1);

	},

	deletemarkItems : function(){

		var oldList = this.items_list;
        this.items_list = [];

        for(var i in oldList){
        	if(!oldList[i].check) this.items_list.push(oldList[i]);
        }

	},

	invalidInputs : function(){

		var invalid_inputs = [];
		var str = "";

		if(this.subject == null || this.subject == ""){
			invalid_inputs.push("Subject is required!");
		}
		if(this.incident_name == null || this.incident_name == ""){
			invalid_inputs.push("Incident Name is required!");
		}
		if(this.incident_date == null || this.incident_date == ""){
			invalid_inputs.push("Incident Date is required!");
		}
		if(this.estimated_family == null || this.estimated_family == ""){
			invalid_inputs.push("Estimated Number of Families to be Served is required!");
		}
		if(this.dromic_file == null || this.dromic_file == "" || typeof this.dromic_file === "undefined" || this.dromic_file.length < 1){
			invalid_inputs.push("DROMIC Report is required!");
		}
		if(this.request_file == null || this.request_file == "" || this.request_file.length < 1){
			invalid_inputs.push("Request Letter is required!");
		}
		if(this.items_list.length < 1){
			invalid_inputs.push("Kindly specify items to be requested!");
		}else{

			for(var i = 0 ; i < this.items_list.length ; i ++){
	        	if(typeof this.items_list[i].item_requested === "undefined" || this.items_list[i].item_requested == "" || this.items_list[i].item_requested == null){
	        		str += "[Item Requested] ";
	        	}
	        	if(typeof this.items_list[i].quantity_requested === "undefined" || this.items_list[i].quantity_requested == "" || this.items_list[i].quantity_requested == null || this.items_list[i].quantity_requested == 0){
	        		str += "[Quantity Requested] ";
	        	}
	        	if(str != ""){
					invalid_inputs.push("Item # "+(i+1)+"'s "+str+" is requred!");
				}
				str = "";
	        }

		}

		return invalid_inputs;

	}

};