#include "Gameboard.h"
#include "Header.h"
#include <iostream>




/*class initialization*/

TicTacToeGame::TicTacToeGame() {
	this->height = 6;
	this->width = 6;
	this->player = 1;
	this->round = 1;
	this->playerX_move = "Player X: ";
	this->playerO_move = "Player O: ";
	this->winner = "";
	this->quitter = "";

    
	//push empty strings on vector

	for (int i = 0; i < height * width; ++i) {
		this->gp.push_back(" ");
	}

	//insert row labels
	for (int i = height - 1; i > 0; --i) { 
		int index = 6 * 0 + i; //0 because for the 1st column
		string s = std::to_string(i- 1);
		this->gp[index] = s;
	}

	//insert column labels 
	for (int i = 1; i <= width - 1; ++i) {
		int index = 6 * i + 0; 
		string s = std::to_string(i - 1);
		this->gp[index] = s;
	}

};
	

	/*accessors*/
	

int TicTacToeGame::getHeight()const {
	return this->height;
}

int TicTacToeGame::getWidth() const {
	return this->width;
}
int TicTacToeGame::getRound()const {
	return this->round;
}

vector<string> TicTacToeGame::getGameboard() const {
	return this->gp;
}

int TicTacToeGame::getPlayer()const {
	return this->player;
}

string TicTacToeGame::getPlayerX_move()const {
	return this->playerX_move;
}
string TicTacToeGame::getPlayerO_move()const {
	return this->playerO_move;
}

string TicTacToeGame::getWinner()const {
	return this->winner;
}
string TicTacToeGame::getQuitter()const {
	return this->quitter;
}

/*mutators*/

void TicTacToeGame::setPlayer(int newPlayer) {
	this->player = newPlayer;
}

void TicTacToeGame::changePlayerX_move(string playerXmove) {
	this->playerX_move = playerXmove;
}
void TicTacToeGame::changePlayerO_move(string playerYmove) {
	this->playerO_move = playerYmove;
}
void TicTacToeGame::increaseRound() {
	this->round++;
}
void TicTacToeGame::setWinner(string winner) {
	this->winner = winner;
}
void TicTacToeGame::setQuitter(string quitter) {
	this->quitter = quitter;
}
/*method declaration*/


bool TicTacToeGame:: done() {
	int grid_size = 3;
	//an array of possible winning moves
	string winning_moves[8] = {
		"123",
		"456",
		"789",
		"147",
		"258",
		"369",
		"159",
		"753"
	}; 

	for (int i = 0; i < 8; ++i) { //for each row 
		bool winner = true;
		string winning_move = winning_moves[i];
		string s = "0";
		int keepIndex = -1;
		for (int j = 0; j < 3; ++j) { //for each digit
			int number = (winning_move.at(j)-'0'); //get number
			int row = (number-1) / grid_size;
			int col = (number-1) % grid_size;
			int x = col + 2; //real coordinate 
			int y = row + 2; //real coordinate 
			int index = 6 * x + y;
			keepIndex = index; 
			string target = this->gp[index];
			if (s == "0") {
				s =target;
			}
			else if (s == target&&s!=" ") {
				continue;
			}
			else {
				winner = false;
				break;
			}

		}
		if (winner) { //if we found a winner 
			//check character
			if (this->gp[keepIndex] == "X") {
				this->setWinner("X");
			}

			else if (this->gp[keepIndex] == "O") {
				this->setWinner("O");
			}

			return true;
		}
	}

	return false; 

}

int TicTacToeGame::prompt(unsigned int& a, unsigned int& b) {
	string userinput;
	cout << "Please enter a command or valid coordinate: ";
	cin >> userinput; 

	//check validity 
	//citation: https://stackoverflow.com/questions/5029840/convert-char-to-int-in-c-and-c
	//https://www.tutorialspoint.com/isalpha-and-isdigit-in-c-cplusplus#:~:text=The%20function%20isdigit()%20is,digit%20otherwise%2C%20it%20returns%20zero.   
	/*while (userinput!="quit"|| (!isdigit(userinput.at(0))) || (!isdigit(userinput.at(2))) || ((userinput.at(0) - '0') < 1) || ((userinput.at(0) - '0') > 3) || ((userinput.at(2) - '0') < 1) || ((userinput.at(2) - '0') > 3)) {
		cout << "Please enter a command or valid coordinate: ";
		cin >> userinput;
	}*/

	while (userinput != "quit") {
		//first check length
		if (userinput.length() == 3) {
			if (userinput.at(0) - '0' >= 1 && userinput.at(0) - '0' <= 3 && userinput.at(2) - '0' >= 1 && userinput.at(2) - '0' <= 3 && userinput.at(1) == ',') {
				break;
			}
			else {
				cout << "Please enter a command or valid coordinate: ";
				cin >> userinput;
			}
		}
		
		else {
			cout << "Please enter a command or valid coordinate: ";
			cin >> userinput;
		}
		

		
	}


	if (userinput == "quit") { //if user chooses to quit 
		return user_quit;
	}
	else {
		if (userinput.at(1) == ',') {
			userinput.at(1) = ' ';
			istringstream iss(userinput);
			if (!(iss >> a)) {
				return extraction_error;
			}
			if (!(iss >> b)) {
				return extraction_error;
			}
		}
		
	}

	if (this->player == 1) { //if it's player X's turn
		string temp = this->getPlayerX_move();
		temp += userinput.at(0);
		temp += ",";
		temp += userinput.at(2);
		temp += ";";
		this->changePlayerX_move(temp);
	}

	if (this->player == 2) { //if it's player O's turn
		string temp = this->getPlayerO_move();
		temp += userinput.at(0);
		temp += ",";
		temp += userinput.at(2);
		temp += ";";
		this->changePlayerO_move(temp);
	}


	return prompt_success; 
}

int TicTacToeGame::turn() {
	unsigned int x;
	unsigned int y;
	//print out message before the turn 
	cout << "It's player " << this->player << "'s turn" << endl;
	if (this->player == 1) {
		cout << "You will use the X game piece" << endl;
	}
	else if (this->player==2){
		cout << "You will use the O game piece" << endl;
	}

	while (true) {
		int prompt_result = prompt(x, y);
		if (prompt_result == user_quit) {
			return turn_quit;
		}
		else if (prompt_result == extraction_error) {
			return turn_extraction_error;
		}
		else {
			//check if the coordinate is occupied 
			int index = (6 * (x+1)) + (y+1);
			bool check = (this->gp[index] == " ");
			if (check) { //if nothing is on the coordinate
				if (this->player == 1) {
					this->gp[index] = "X";

					//print out gameboard
					cout << *this << endl;
					//blank line
					cout << " " << endl;
					//print out moves so far for that player
					cout << this->playerX_move << endl;
					this->setPlayer(2); //swap turns
				}
				else if (this->player == 2) {
					this->gp[index] = "O";
					//print out gameboard
					cout << *this << endl;
					//blank line
					cout << " " << endl;
					//print out moves so far for that player
					cout << this->playerO_move << endl;
					this->setPlayer(1);
				}
				
				this->increaseRound(); //round++
				return turn_success;
			}
			else { //if the coordinate is occupied
				cout << "The coordinate is occupied. Please enter another coordinate" << endl;

			}
		}
	}

}

bool TicTacToeGame::draw() {
	if (this->done()) {
		return false;
	}

	else {
		int count = 0;
		for (int i = 2; i <=4; ++i) { //row
			for (int j = 2; j <= 4; ++j) {//col
				int index = 6 * j + i;
				if (this->gp[index] != " ") { //if string is not empty
					count++; 
				}
			}
		}
		if (count == 9) {
			return true;
		}
		else {
			return false; 
		}
	}

}

int TicTacToeGame::play() {

	//print gameboard
	cout << *this << endl; 
	while (true) {
		int turnResult=turn();
		bool doneResult=done();
		bool drawResult=draw();

		if (doneResult) {
			cout << this->getWinner() << " has won the game!" << endl;
			return play_success;
		}
		if (drawResult) {
			cout << this->round << " rounds have been played and there are no moves remaining. It's a draw!" << endl;
			return play_failure_draw;
		}
		if (turnResult == turn_quit) {
			cout << this->round << " rounds have been played and one player quits. Game ended!" << endl;
			return play_failure_quit;
		}
	}

}




ostream& operator <<(ostream& out, const TicTacToeGame& g) { //define insertion operator that prints out gameboard
	
	int row = g.height-1; //starts at the top row 

	out << "The game board: " << endl;

	for (row; row >= 0; --row) {
		for (int col = 0; col < g.width; ++col) {
			int index = (g.width * col) + row;
			out<<g.gp[index]<<" ";
		}
		out << endl;
	}
	return out; 
}

int read_gameboard(ifstream& ifs, unsigned int& x, unsigned int& y) {

	string s = "";


	if (!getline(ifs, s)) {
		return error_reading_line;
	}

	istringstream iss(s);//wrap string in an istringstream

	if (!(iss >> x)) {//extract first value
		return error_extracting_dimensions;
	}

	if (!(iss >> y)) { //extract second value 
		return error_extracting_dimensions;
	}


	return extraction_success;

}


int read_gamepieces(ifstream& ifs, vector<Gamepieces::games_pieces>& gp, unsigned int x_horizontal, unsigned int y_vertical) {
	string s = "";
	int count2 = 0; //for # of well-formed piece 
	while (getline(ifs, s)) { //while there're still ines to read
		istringstream iss(s); //wrap line in an istringstream
		string gamepiece_color = "";
		string gamepiece_name = "";
		string display = "";
		unsigned int x;
		unsigned int y;
		int count = 0; //for extraction


		if ((iss >> gamepiece_color)) {
			if (gamepiece_color == "red" || gamepiece_color == "white" || gamepiece_color == "blue") {
				count++;
			}

		}
		if ((iss >> gamepiece_name)) {
			count++;
		}
		if ((iss >> display)) {
			count++;
		}
		if ((iss >> x)) {
			count++;
		}
		if ((iss >> y)) {
			count++;
		}

		//check if all five values are extracted successfully 

		if (count == 5) {
			//convert first string to enum label
			enum piece_color color = string_to_color(gamepiece_color);

			//compare horizontal, vertical to corresponding dimensions 
			if (x >= x_horizontal || y >= y_vertical) {
				continue;

			}
			else {
				int index = (x_horizontal * y) + x;
				gp[index].color = color;
				gp[index].display = display;
				gp[index].name = gamepiece_name;
				count2++;
			}
		}

		else { //skip over to the next line 
			continue;
		}


	}

	if (count2 >= 1) {
		return read_success;
	}
	else {
		return fail_to_find_well_formed_pieces;
	}

}

int print_out_pieces(const vector<Gamepieces::games_pieces>& gp, unsigned int x_horizontal, unsigned int y_vertical) {

	//check dimension
	if (gp.size() < x_horizontal * y_vertical) {
		return wrong_size;
	}

	else {
		unsigned int row = y_vertical - 1; //starts at the top row 

		for (row; row >= 0; --row) {
			for (unsigned int col = 0; col < x_horizontal; ++col) {
				int index = (x_horizontal * row) + col;
				cout << gp[index].display << "";
			}
			cout << endl;
		}



		return print_success;
	}

	
}

