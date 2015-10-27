## Object examiner

Prints objects public methods. If that object has properties that are also object, it 
prints their methods too. Useful if you have an object that is constructed out of a string and
you can't find it. 

### Usage

`ObjectExaminer::init()->examine($object);`

That is it. It will `var_dump` objects methods and kill the script. 