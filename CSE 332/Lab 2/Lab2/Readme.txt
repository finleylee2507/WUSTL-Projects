Lab 2
Name: Finley Li
ID: 465060

Debugging logs:
	1.Fixed missing "using namespace std" in Gamepieces.h
	2.Fixed missing "#include <string>" in Gampieces.h 


Test trials:
	1. When additional argument is given, the program prints out "Lab2.exe <input_file _name>", which is the correct
	   behavior. The value returned by the program is -2, indicating an invalid command line input. 
	2. Input: Lab2.exe tic-tac-toe.txt
       Output: 
	    
	    X X O
            O X
            X O O

		The program correctly prints out the pattern on the board deatiled in "tic-tac-toe.txt". The value returned is 
		0, indicating the success of the execution. 

    3. Input: Lab2.exe gomoku.txt
	   Output:
	    O  O  O  O
	   O  O  O  O
            O  O  O  O


           X  X  X  X
	    X  X  X  X
           X  X  X  X

	   The program correctly prints out the pattern on the board detailed in "gomoku.txt". The program returns 0 as its return 
	   value, indicating the successful execution of the program. 

     4. I did a slight modification in my "tic-tac-toe.txt". I changed the first line from "3 3" to "1 3", which means only 1
	    column should be printed out. I then saved the content in a new file name "tic-tac-toe-test.txt" and ran the program
		using the new file as my command line argument. 
		
		Input: Lab2.exe tic-tac-toe-test.txt
		Output:
		X
		O
		X

		The program behaves as expected and returns 0. I changed the dimension of the board back to 3 X 3 after the run. 

     5. In this trial, I added an additional empty line after every line in "tic-tac-toe-test.txt" and ran the program.

	    Input: Lab2.exe tic-tac-toe-test.txt
		Output: 
		X X O
		O X
		X O O

		The program simply ignores the whitespaces and returns 0. This is the desired behavior it should have. 

     6. In this trial, I replaced all the whitespaces from the previous trial with random characters and punctuations.
	    
		Input: Lab2.exe tic-tac-toe-test.txt
		Output:
		X X O
		O X
		X O O

		The program successfully ignores/filters out the unnecessary information and correctly prints out the pattern
		and returns 0. 
 
      7. In this trial, I changed some of the coordinates in "tic-tac-toe-test.txt" and ran the program.
	   Input: Lab2.exe tic-tac-toe-test.txt
	   Output:
	       X X O
		 X
		X  O
      
	    The program updated the coordinates and prints out the gameboard with pieces all in the right positions. The
	    program also returns 0, indicating success. 

	  8. In this trial, I deleted the first line of the file, which specifies the dimension of the gameboard.
	     Input: Lab2.exe tic-tac-toe-test.txt
		 Output:
		 The program can't extract useful information from the file

		 The program finished with the above message, which would happen when no dimension is provided. The program behaves
		 as expected. The program also returns -2 as its value, which is the number represented by the enum label
		 "error_extracting_dimensions". 

	   9. In this trial, I deleted all the lines in the file except for the first one, which is the dimension of the gameboard.
	   
	   Input:  Lab2.exe tic-tac-toe-test.txt
	   Output:
	   Failed to read gamepieces from input file stream 

	   The program finished with the message above, indicating that it fails to read in any gamepieces and the gameboard remains
	   unchanged. The program returns -1 as its value, which is the number represented by the enum label "fail_to_find_well_formed_pieces".

	   10. In this trial, I changed two of the piece colors in "tic-tac-toe-test.txt" to green, which is an invalid color. 
	   Input:Lab2.exe tic-tac-toe-test.txt
	   Output:
	    X O
	   O X
	    O O
		
       The program finished and printed out a different gameboard and returned 0. The pieces with invalid color didn't get printed.
	   This is the desired behavior. 



	     