# WHAT 'S DOES IT MEAN ?
# Access Control Level / List


"Guest" have all (*) permissions in the Home controller
"Gest" have permissions to access only "login", "register"
Everythings restricted

{
	"Guest" : {
		"denied" : {},
		"Home" : ["*"],
		"Register" : ["login", "register"],
		"Restricted" : [*] 
	}
}
