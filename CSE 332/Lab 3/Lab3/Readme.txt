Name: Finley Li
Lab 3 
ID: 465060 

I didn't run into any errors when I built the program. But several warnings were shwon. 

1. 
1>H:\finleyli_folder\Labs-finleylee2507\lab3-finleylee2507\Lab3\Header.h(15,10): warning C4067:  unexpected tokens following preprocessor directive - expected a newline
Solution: Delete the semicolons in all the header files. 

2. 
1>H:\finleyli_folder\Labs-finleylee2507\lab3-finleylee2507\Lab3\Gameboard.cpp(467,25): warning C4018:  '<': signed/unsigned mismatch
Solution: Changed int into unsigned int in the for loop declarations.

3. 
1>H:\finleyli_folder\Labs-finleylee2507\lab3-finleylee2507\Lab3\Gameboard.cpp(455): warning C4715:  'read_gamepieces': not all control paths return a value
Solution: Add an else statement that immediately follows any if statment inside the print_out_pieces() method. 




Test Cases:

1. No additional argument is given. 

			Input:  H:\finleyli_folder\Labs-finleylee2507\lab3-finleylee2507\Lab3\Debug>Lab3.exe
			Output: Lab3.exe TicTacToe
			Error level: -2

			The program behaves as expected and returns -2, which is the value for the label "errorinvalidinput". 


2. Quit on the first turn:

			Input/output: 
			H:\finleyli_folder\Labs-finleylee2507\lab3-finleylee2507\Lab3\Debug>Lab3.exe TicTacToe
			The game board:
			4
			3
			2
			1
			0
			 0 1 2 3 4

			It's player 1's turn
			You will use the X game piece
			Please enter a command or valid coordinate: quit
			1 rounds have been played and one player quits. Game ended!

			Error level: -2

			The program behaves as expected and returns -2, which is the value for the label "play_fail_quit". 


3. Invalid coordinates +quit

Input/output: 

			H:\finleyli_folder\Labs-finleylee2507\lab3-finleylee2507\Lab3\Debug>Lab3.exe TicTacToe
			The game board:
			4
			3
			2
			1
			0
			  0 1 2 3 4

			It's player 1's turn
			You will use the X game piece
			Please enter a command or valid coordinate: 4,4
			Please enter a command or valid coordinate: 1,4
			Please enter a command or valid coordinate: 1,1
			The game board:
			4
			3
			2
			1   X
			0
			  0 1 2 3 4


			Player X: 1,1;
			It's player 2's turn
			You will use the O game piece
			Please enter a command or valid coordinate: 2,2
			The game board:
			4
			3
			2     O
			1   X
			0
			  0 1 2 3 4


			Player O: 2,2;
			It's player 1's turn
			You will use the X game piece
			Please enter a command or valid coordinate: quit
			3 rounds have been played and one player quits. Game ended!

		Error level: -2

		The program behaves as expected and returns -2, which is the value for the label "play_fail_quit". 



 4. Normal gameplay till one player wins.
 
 Input/output:

		 H:\finleyli_folder\Labs-finleylee2507\lab3-finleylee2507\Lab3\Debug>Lab3.exe TicTacToe
		The game board:
		4
		3
		2
		1
		0
		  0 1 2 3 4

		It's player 1's turn
		You will use the X game piece
		Please enter a command or valid coordinate: 1,1
		The game board:
		4
		3
		2
		1   X
		0
		  0 1 2 3 4


		Player X: 1,1;
		It's player 2's turn
		You will use the O game piece
		Please enter a command or valid coordinate: 2,2
		The game board:
		4
		3
		2     O
		1   X
		0
		  0 1 2 3 4


		Player O: 2,2;
		It's player 1's turn
		You will use the X game piece
		Please enter a command or valid coordinate: 1,2
		The game board:
		4
		3
		2   X O
		1   X
		0
		  0 1 2 3 4


		Player X: 1,1;1,2;
		It's player 2's turn
		You will use the O game piece
		Please enter a command or valid coordinate: 2,2
		The coordinate is occupied. Please enter another coordinate
		Please enter a command or valid coordinate: 2,3
		The game board:
		4
		3     O
		2   X O
		1   X
		0
		  0 1 2 3 4


		Player O: 2,2;2,2;2,3;
		It's player 1's turn
		You will use the X game piece
		Please enter a command or valid coordinate: 1,3
		The game board:
		4
		3   X O
		2   X O
		1   X
		0
		  0 1 2 3 4


		Player X: 1,1;1,2;1,3;
		X has won the game!


		Error level: 0

		The program behaves as expected. When one user tries to enter a coordinate that's already occupied, the program
		prompts the user to reenter a valid coordinate. The program finishes executing with one player winning and returns 
		the value 0, indicating a successful execution. 



5. 

Normal gameplay + tie 

Input/output:


		H:\finleyli_folder\Labs-finleylee2507\lab3-finleylee2507\Lab3\Debug>Lab3.exe TicTacToe
		The game board:
		4
		3
		2
		1
		0
		  0 1 2 3 4

		It's player 1's turn
		You will use the X game piece
		Please enter a command or valid coordinate: 1,1
		The game board:
		4
		3
		2
		1   X
		0
		  0 1 2 3 4


		Player X: 1,1;
		It's player 2's turn
		You will use the O game piece
		Please enter a command or valid coordinate: 1,3
		The game board:
		4
		3   O
		2
		1   X
		0
		  0 1 2 3 4


		Player O: 1,3;
		It's player 1's turn
		You will use the X game piece
		Please enter a command or valid coordinate: 1,2
		The game board:
		4
		3   O
		2   X
		1   X
		0
		  0 1 2 3 4


		Player X: 1,1;1,2;
		It's player 2's turn
		You will use the O game piece
		Please enter a command or valid coordinate: 2,2
		The game board:
		4
		3   O
		2   X O
		1   X
		0
		  0 1 2 3 4


		Player O: 1,3;2,2;
		It's player 1's turn
		You will use the X game piece
		Please enter a command or valid coordinate: 3,1
		The game board:
		4
		3   O
		2   X O
		1   X   X
		0
		  0 1 2 3 4


		Player X: 1,1;1,2;3,1;
		It's player 2's turn
		You will use the O game piece
		Please enter a command or valid coordinate: 2,1
		The game board:
		4
		3   O
		2   X O
		1   X O X
		0
		  0 1 2 3 4


		Player O: 1,3;2,2;2,1;
		It's player 1's turn
		You will use the X game piece
		Please enter a command or valid coordinate: 2,3
		The game board:
		4
		3   O X
		2   X O
		1   X O X
		0
		  0 1 2 3 4


		Player X: 1,1;1,2;3,1;2,3;
		It's player 2's turn
		You will use the O game piece
		Please enter a command or valid coordinate: 3,2
		The game board:
		4
		3   O X
		2   X O O
		1   X O X
		0
		  0 1 2 3 4


		Player O: 1,3;2,2;2,1;3,2;
		It's player 1's turn
		You will use the X game piece
		Please enter a command or valid coordinate: 3,3
		The game board:
		4
		3   O X X
		2   X O O
		1   X O X
		0
		  0 1 2 3 4


		Player X: 1,1;1,2;3,1;2,3;3,3;
		10 rounds have been played and there are no moves remaining. It's a draw!		

		Error level: -1

		The program behaves as expected and prints out a message when there's a tie. In addition, it returns the value
		-1, which is the value for the enum label "play_failure_draw". 




