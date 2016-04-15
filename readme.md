
ple Profiler
Identity
Persons will be identified numerically then assigned a name and other information as a characteristics, because any information known about an individual is suspect.

Characteristics 
(Discrete Information)
Examples
-Names
-Color (eye, hair)
-Date
-Ethnicity
-Gender
-Formally Defined Relationships
-Place
-Religion
-Vehicles

I would have liked to have a composite type composed of composite types but I'm having trouble visualizing the structure.

Simple Types
id, name

Composite Types
id, group_id, type_id

Characteristic Record
id, simple_id, group_id, value 

It’s important that value could be a string, number or date.

If this were a record of simple type, the simple id would be the simple type and the composite_group_id would be 0. If this were a composite record, the simple_id would be the composite_type_id and the composite_group_id

Narrative 
(Non-Discrete Information)
Notes about the person or regarding a characteristic.

Sources / Evidence 

This could be an entire app on its own. It would download from all the major social networks information about that person and ideally their entire social network’s information as well.

Facebook, Instagram, Twitter, Reddit
