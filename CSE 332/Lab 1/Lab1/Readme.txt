
Lab 1, Finley Li, Student id: 465060


1. Fortunately, I didn't run into any error when I built my program. 

2. Test caes: 
	a. 
		Input: Lab1.exe
		Output: Lab1.exe <input_file _name>
		Check errorcode: -2 
		Summary: 
				When no user input is given, the progarm prints out the intended usage message and returns the value -2, which 
		         is the value that the enuermation label "errorinvalidinput" represents. 


	b. 
		Input: Lab1.exe input_file.txt
		Output: 
		Non-digit strings: these
		Non-digit strings: all
		Non-digit strings: are
		Non-digit strings: strings0
		Non-digit strings: 197stringstr4ingstring2more
		Non-digit strings: strings
		12
		3
		5
		7
		11
		13
		17

		Check errorcode: 0 
		Summary:
			When the correct name of the input_file.txt is entered, the program printed out the non-digit strings, followed
			by digit strings, which is the behavior we're expecting when nothing goes wrong. In addition, the program returns the 
			integer value 0, which is the number represented by the enumeration label "success".  



	c. 
		Input: Lab1.exe inputfile.txt 
		Output: None
		Check errorcode: -1 
		Summary:
			When an incorrect filename is entered, the program didn't print out anything and returned the integer value -1, which 
			is represented by the enumeration label "erroropeningfile". This is the correct behavior we're expecting because the 
			program is having troubles opening the specified file as it doesn't exist.

	d. 
		Input: Lab1.exe empty_file.txt
		Output: None 
		Check errorcode: 0
		Summary:
			When I passed in the name of an empty file I created in the command line argument, the program outputs nothing and returns
			the integer value 0. This is the correct behavior because the program did successfully open the file, albeit finding nothing
			to push onto the vector and print out. 


    e.
		Input: Lab1.exe only_nondigit.txt
		Output:

		Non-digit strings: This
		Non-digit strings: is
		Non-digit strings: a
		Non-digit strings: test
		Non-digit strings: There's
		Non-digit strings: no
		Non-digit strings: number
		Non-digit strings: in
		Non-digit strings: here!
		Non-digit strings: I
		Non-digit strings: love
		Non-digit strings: you!

		Check error code: 0

		Summary:
			When I passed in a file that contains only non-digit strings, the program printed them out, each on its own line 
			and prefixed with the informative phrase "Non-digit strings". In addition, the program returns the integer 0,
		    indicating that there's no error found. The program behaves as intended. 

	f. 
		Input: Lab1.exe only_digit.txt
		Output:

		123422
		23
		2323
		23
		232
		124213

		Check error code: 0 

		Summary:
			When I passed in a file that contains only numeric strings, the program pushed them on the int vector and
			printed them out, each on its own line. The program also returns the integer 0, meaning that there's no error found. The 
			program behaves as intended. 


    g. 
		Input: Lab1.exe input_file.txt 123
		Output: Lab1.exe <input_file _name> 
		Check error code: -2 

		Summary:
			When 2 user inputs are provided, the program returns the usage message and tells the user the correct way to execute
			the program. The program returns the integer -2, suggesting that the input is invalid. The program behaves as intended. 

		


      
	  Extra Credit:
	  
	  [li.f@shell ~]$ ls
		artifacts.xml  eclipse.configuration  Music         perl5     studio-0-cheng-konst-li-wu  WINDOWS
		Desktop        eclipse-workspace      My Documents  Pictures  Templates                   winprofile
		Downloads      finleyli_folder        p2            Public    Videos



       Note: I didn't finish the rest as the program always returned errors when it's being built. 
