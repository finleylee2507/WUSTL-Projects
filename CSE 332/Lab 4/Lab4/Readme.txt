Team members: Finley Li (465060), Andrew Wu (465486)


Warnings: 

When we first built the program, there were several warnings about base class member variables (int) not initialized. We fixed them by assigning 
these base class member variables an initial value of 0.  




Testcases:

1. No additional argument is given.

		Input: H:\finleyli_folder\Labs-finleylee2507\lab4-lab4-finley-andrew\Lab4\Debug>Lab4.exe
		Output:		Lab4.exe Gamename
		Error level: -2

		The program behaves as expected, prints out the usage message and returns -2, which is the value for the label "errorinvalidinput". 


2. Wrong gamename is given.
			Input: H:\finleyli_folder\Labs-finleylee2507\lab4-lab4-finley-andrew\Lab4\Debug>Lab4.exe abc
			Output:	Lab4.exe Gamename
			Error level: -2


		The program behaves as expected, prints out the usage message and returns -2, which is the value for the label "errorinvalidinput". 


3. TicTacToe game is played. Player quit on the first turn:

			Input/output: 
			
			H:\finleyli_folder\Labs-finleylee2507\lab4-lab4-finley-andrew\Lab4\Debug>Lab4.exe TicTacToe
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
			0 round(s) have been played and one player quits. Game ended!

			Error level: -2

			The program behaves as expected and returns -2, which is the value for the label "play_fail_quit". 


4. TicTacToe game is played. Invalid coordinates +quit

Input/output: H:\finleyli_folder\Labs-finleylee2507\lab4-lab4-finley-andrew\Lab4\Debug>Lab4.exe TicTacToe

			
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
			2 round(s) have been played and one player quits. Game ended!

		Error level: -2

		The program behaves as expected and returns -2, which is the value for the label "play_fail_quit". 



 5. TicTacToe game is played. Normal gameplay till one player wins.
 
 Input/output:

		H:\finleyli_folder\Labs-finleylee2507\lab4-lab4-finley-andrew\Lab4\Debug>Lab4.exe TicTacToe
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

TicTacToe game is played. Normal gameplay + tie. 

Input/output:


		H:\finleyli_folder\Labs-finleylee2507\lab4-lab4-finley-andrew\Lab4\Debug>Lab4.exe TicTacToe
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
		9 round(s) have been played and there are no moves remaining. It's a draw!		

		Error level: -1

		The program behaves as expected and prints out a message when there's a tie. In addition, it returns the value
		-1, which is the value for the enum label "play_failure_draw". 	



6. 
Gomoku game is played. Player quits in the first round. 

Input/output:
	H:\finleyli_folder\Labs-finleylee2507\lab4-lab4-finley-andrew\Lab4\Debug>Lab4.exe Gomoku
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4

	3

	2

	1

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18


	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: quit
	0 round(s) have been played and one player quits. Game ended!

	Error level: -2

	The program behaves as expected and returns -2, which is the value for the label "play_fail_quit".  


7. 
Gomoku game is played. Invalid input+ player quits. 

Input/output:

	H:\finleyli_folder\Labs-finleylee2507\lab4-lab4-finley-andrew\Lab4\Debug>Lab4.exe Gomoku
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4

	3

	2

	1

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18


	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: -2,-2
	Please enter valid coordinate: 100,100
	Please enter valid coordinate: 23212
	Please enter valid coordinate: quit
	0 round(s) have been played and one player quits. Game ended!


	Error level: -2


	The program behaves as expected and returns -2, which is the value for the label "play_fail_quit". 

8.  Normal gameplay till one player wins (5 pieces on the same row).

	Input/output:

	H:\finleyli_folder\Labs-finleylee2507\lab4-lab4-finley-andrew\Lab4\Debug>Lab4.exe Gomoku
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4

	3

	2

	1

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18


	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 0,1
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4

	3

	2

	1   B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 0,1;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 13,2
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4

	3

	2                                                       W

	1   B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 13,2;
	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 1,1
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4

	3

	2                                                       W

	1   B   B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 0,1;1,1;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 14,4
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4                                                           W

	3

	2                                                       W

	1   B   B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 13,2;14,4;
	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 2,1
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4                                                           W

	3

	2                                                       W

	1   B   B   B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 0,1;1,1;2,1;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 10,2
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4                                                           W

	3

	2                                           W           W

	1   B   B   B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 13,2;14,4;10,2;
	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 3,1
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4                                                           W

	3

	2                                           W           W

	1   B   B   B   B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 0,1;1,1;2,1;3,1;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 10,3
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4                                                           W

	3                                           W

	2                                           W           W

	1   B   B   B   B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 13,2;14,4;10,2;10,3;
	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 4,1
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4                                                           W

	3                                           W

	2                                           W           W

	1   B   B   B   B   B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 0,1;1,1;2,1;3,1;4,1;
	B  has won the game!

	Error level: 0


	The program behaves as expected. The program finishes executing with one player winning and returns the value 0, indicating a successful execution. 


9. Normal gameplay till one player wins (5 pieces on the same column). 

	Input/output:

	
	H:\finleyli_folder\Labs-finleylee2507\lab4-lab4-finley-andrew\Lab4\Debug>Lab4.exe Gomoku
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4

	3

	2

	1

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18


	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 13,3
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4

	3                                                       B

	2

	1

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 13,3;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 1,1
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4

	3                                                       B

	2

	1       W

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 1,1;
	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 15,5
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5                                                               B

	4

	3                                                       B

	2

	1       W

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 13,3;15,5;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 1,2
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5                                                               B

	4

	3                                                       B

	2       W

	1       W

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 1,1;1,2;
	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 13,3
	The coordinate is occupied. Please enter another coordinate
	Please enter a command or valid coordinate: 14,6
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6                                                           B

	5                                                               B

	4

	3                                                       B

	2       W

	1       W

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 13,3;15,5;13,3;14,6;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 1,3
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6                                                           B

	5                                                               B

	4

	3       W                                               B

	2       W

	1       W

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 1,1;1,2;1,3;
	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 7,3
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6                                                           B

	5                                                               B

	4

	3       W                       B                       B

	2       W

	1       W

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 13,3;15,5;13,3;14,6;7,3;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 1,4
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6                                                           B

	5                                                               B

	4       W

	3       W                       B                       B

	2       W

	1       W

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 1,1;1,2;1,3;1,4;
	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 11,1
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6                                                           B

	5                                                               B

	4       W

	3       W                       B                       B

	2       W

	1       W                                       B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 13,3;15,5;13,3;14,6;7,3;11,1;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 1,5
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6                                                           B

	5       W                                                       B

	4       W

	3       W                       B                       B

	2       W

	1       W                                       B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 1,1;1,2;1,3;1,4;1,5;
	W  has won the game!

	Error level: 0


	The program behaves as expected. When one user tries to enter a coordinate that's already occupied, the program
	prompts the user to reenter a valid coordinate. The program finishes executing with one player winning and returns 
	the value 0, indicating a successful execution. 


10. Normal gameplay till one player wins (5 pieces on the main diagonal)

Input/output:

	H:\finleyli_folder\Labs-finleylee2507\lab4-lab4-finley-andrew\Lab4\Debug>Lab4.exe Gomoku
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4

	3

	2

	1

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18


	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 0,9
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9   B

	8

	7

	6

	5

	4

	3

	2

	1

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 0,9;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 18,0
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9   B

	8

	7

	6

	5

	4

	3

	2

	1

	0                                                                           W

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 18,0;
	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 1,8
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9   B

	8       B

	7

	6

	5

	4

	3

	2

	1

	0                                                                           W

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 0,9;1,8;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 12,2
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9   B

	8       B

	7

	6

	5

	4

	3

	2                                                   W

	1

	0                                                                           W

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 18,0;12,2;
	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 2,7
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9   B

	8       B

	7           B

	6

	5

	4

	3

	2                                                   W

	1

	0                                                                           W

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 0,9;1,8;2,7;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 10,1
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9   B

	8       B

	7           B

	6

	5

	4

	3

	2                                                   W

	1                                           W

	0                                                                           W

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 18,0;12,2;10,1;
	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 3,6
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9   B

	8       B

	7           B

	6               B

	5

	4

	3

	2                                                   W

	1                                           W

	0                                                                           W

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 0,9;1,8;2,7;3,6;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 15,5
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9   B

	8       B

	7           B

	6               B

	5                                                               W

	4

	3

	2                                                   W

	1                                           W

	0                                                                           W

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 18,0;12,2;10,1;15,5;
	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 4,5
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9   B

	8       B

	7           B

	6               B

	5                   B                                           W

	4

	3

	2                                                   W

	1                                           W

	0                                                                           W

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 0,9;1,8;2,7;3,6;4,5;
	B  has won the game!

	Error Level:0 

	The program behaves as intended and returns the integer value 0, signaling a successful run. 


10. Normal + one player wins (on the second diagonal)

Input/output:

	H:\finleyli_folder\Labs-finleylee2507\lab4-lab4-finley-andrew\Lab4\Debug>Lab4.exe Gomoku
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4

	3

	2

	1

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18


	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 1,1
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10

	9

	8

	7

	6

	5

	4

	3

	2

	1       B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 1,1;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 10,10
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10                                          W

	9

	8

	7

	6

	5

	4

	3

	2

	1       B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 10,10;
	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 1,2
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10                                          W

	9

	8

	7

	6

	5

	4

	3

	2       B

	1       B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 1,1;1,2;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 9,9
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10                                          W

	9                                       W

	8

	7

	6

	5

	4

	3

	2       B

	1       B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 10,10;9,9;
	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 3,4
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10                                          W

	9                                       W

	8

	7

	6

	5

	4               B

	3

	2       B

	1       B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 1,1;1,2;3,4;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 8,8
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10                                          W

	9                                       W

	8                                   W

	7

	6

	5

	4               B

	3

	2       B

	1       B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 10,10;9,9;8,8;
	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 18,1
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10                                          W

	9                                       W

	8                                   W

	7

	6

	5

	4               B

	3

	2       B

	1       B                                                                   B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 1,1;1,2;3,4;18,1;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 7,7
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10                                          W

	9                                       W

	8                                   W

	7                               W

	6

	5

	4               B

	3

	2       B

	1       B                                                                   B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 10,10;9,9;8,8;7,7;
	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 12,1
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10                                          W

	9                                       W

	8                                   W

	7                               W

	6

	5

	4               B

	3

	2       B

	1       B                                           B                       B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 1,1;1,2;3,4;18,1;12,1;
	It's player 2's turn
	You will use the W game piece
	Please enter a command or valid coordinate: 6,6
	The game board:
	18

	17

	16

	15

	14

	13

	12

	11

	10                                          W

	9                                       W

	8                                   W

	7                               W

	6                           W

	5

	4               B

	3

	2       B

	1       B                                           B                       B

	0

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player W: 10,10;9,9;8,8;7,7;6,6;
	W  has won the game!

	Error level: 0

The program behaves as intended and returns 0, indicating success. 



11. 

Draw. Note:".." is used as place holder to initialize partially filled board. 

	It's player 1's turn
	You will use the B game piece
	Please enter a command or valid coordinate: 18,17
	The game board:
	18  B   W   B   W   B   W   B   W   B   W   B   W   B   W   B   W   B   W   B

	17  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  B

	16  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  W

	15  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  B

	14  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  W

	13  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  B

	12  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  W

	11  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  B

	10  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  W

	9   ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  B

	8   ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  W

	7   ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  B

	6   ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  B

	5   ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  W

	4   ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  B

	3   ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  W

	2   ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  B

	1   ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  W

	0   ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  ..  W

		0   1   2   3   4   5   6   7   8   9   10  11  12  13  14  15  16  17  18



	Player B: 0,18;2,18;4,18;6,18;8,18;10,18;12,18;14,18;16,18;18,18;18,2;18,4;18,6;18,7;18,9;18,11;18,13;18,15;18,17;
	37 round(s) have been played and there are no moves remaining. It's a draw!

	Error level:-1

	The program behaves as intended and returns the integer value -1, indicating there's a draw. 

















































































































































