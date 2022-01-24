#include "Gameboard.h"
#include "header.h"
#include <iostream>
#include <algorithm>

void lowercase(string& input) {		//function that converts a string into all lowercase
	//https://stackoverflow.com/questions/5539249/why-cant-transforms-begin-s-end-s-begin-tolower-be-complied-successfu
	transform(input.begin(), input.end(), input.begin(), ::tolower);
}

/*class initialization*/

TicTacToeGame::TicTacToeGame() {
	this->height = 6;
	this->width = 6;
	this->player = 1;
	this->round = 1;
	this->player1_move = "Player X: ";
	this->player2_move = "Player O: ";
	this->winner = "";
	this->quitter = "";
	this->longestPiece = 1;

	//push empty strings on vector
	for (int i = 0; i < height * width; ++i) {
		this->gp.push_back(" ");
	}

	//insert row labels
	for (int i = height - 1; i > 0; --i) { 
		int index = this->width * 0 + i; //0 because for the 1st column
		string s = std::to_string(i- 1);
		this->gp[index] = s;
	}

	//insert column labels 
	for (int i = 1; i <= width - 1; ++i) {
		int index = this->width * i + 0; 
		string s = std::to_string(i - 1);
		this->gp[index] = s;
	}
};

GomokuGame::GomokuGame() {
	this->height = 20;
	this->width = 20;
	this->player = 1;
	this->round = 1;
	this->player1_move = "Player B: ";
	this->player2_move = "Player W: ";
	this->winner = "";
	this->quitter = "";
	this->longestPiece = 2;

	//push empty strings on vector
	for (int i = 0; i < height * width; ++i) {
		this->gp.push_back("  ");
	}

	//insert row labels
	for (int i = height - 1; i > 0; --i) {
		int index = this->width * 0 + i; //0 because for the 1st column
		string s = std::to_string(i - 1);
		if (s.length() < 2) { //append extra space for numbers <10
			s.append(" ");
		}
		this->gp[index] = s;
	}

	//insert column labels 
	for (int i = 1; i <= width - 1; ++i) {
		int index = this->width * i + 0;
		string s = std::to_string(i - 1);
		if (s.length() < 2) {
			s.append(" ");
		}
		this->gp[index] = s;
	}

	

};


/*mutators*/
void TicTacToeGame::setPlayer(int newPlayer) {
	this->player = newPlayer;
}

void TicTacToeGame::changeplayer1_move(string playerXmove) {
	this->player1_move = playerXmove;
}
void TicTacToeGame::changeplayer2_move(string playerYmove) {
	this->player2_move = playerYmove;
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


void GomokuGame::setPlayer(int newPlayer) {
	this->player = newPlayer;
}

void GomokuGame::changeplayer1_move(string playerXmove) {
	this->player1_move = playerXmove;
}
void GomokuGame::changeplayer2_move(string playerYmove) {
	this->player2_move = playerYmove;
}
void GomokuGame::increaseRound() {
	this->round++;
}
void GomokuGame::setWinner(string winner) {
	this->winner = winner;
}
void GomokuGame::setQuitter(string quitter) {
	this->quitter = quitter;
}

/*method declaration*/
GameBase* GameBase::chooseGame(int argc, char* argv[]) {
	if (argc != 2) {
		GameBase* pointer = 0;
		return pointer;
	}
	else {
		if (string(argv[inputfilename]) == "TicTacToe") {
			GameBase* game = new TicTacToeGame();
			return game;
		}
		else if (string(argv[inputfilename]) == "Gomoku") {
			GameBase* game = new GomokuGame();
			return game;
		}
		else {
			GameBase* pointer = 0;
			return pointer;
		}
	}
}

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

//citation: https://stackoverflow.com/questions/47754747/gomoku-diagonal-winning-condition
bool GomokuGame::done() {
	//check row
	for (int row = 1; row < height; row++) {
		for (int col = 1; col < width - 4; col++)
		{
			bool match = true;
			int index = (this->width * col) + row; //get vector index
			string target = this->gp[index];
			for (int i = 0; i < 5; i++) {
				int checkIndex = (this->width * (col + i)) + row;
				string check = this->gp[checkIndex];
				if (target != check || check == "  ") {
					match = false;
				}
			}
			if (match) { //if 5 in a row
				this->winner = target;
				return true;
			}
		}
	}

	//check columns  
	for (int col = 1; col < width; col++) {
		for (int row = 1; row < height - 4; row++)
		{
			bool match = true;
			int index = (this->width * col) + row; //get vector index
			string target = this->gp[index];
			for (int i = 0; i < 5; i++) {
				int checkIndex = (this->width * col) + (row + i);
				string check = this->gp[checkIndex];
				if (target != check || check == "  ") {
					match = false;
				}
			}
			if (match) { //if 5 in a row
				this->winner = target;
				return true;
			}
		}
	}


	//check first diagonal
	for (int col = 1; col <width - 4; col++) {
		for (int row = 1; row <height - 4; row++)
		{
			bool match = true;
			int index = (this->width * col) + row; //get vector index
			string target = this->gp[index];
			for (int i = 0; i < 5; i++) {
				int checkIndex = (this->width * (col+i)) + (row + i);
				string check = this->gp[checkIndex];
				if (target != check || check == "  ") {
					match = false;
				}
			}
			if (match) { //if 5 in a row
				this->winner = target;
				return true;
			}
		}
	}

	//check second diagonal
	for (int col = 0; col < width - 4; col++) {
		for (int row = height-1; row >=6; row--)
		{
			bool match = true;
			int index = (this->width * col) + row; //get vector index
			string target = this->gp[index];
			for (int i = 0; i < 5; i++) {
				int checkIndex = (this->width * (col + i)) + (row - i);
				string check = this->gp[checkIndex];
				if (target != check || check == "  ") {
					match = false;
				}

			}
			if (match) { //if 5 in a row
				this->winner = target;
				return true;
			}
		}
	}
	return false;
}

int GameBase::prompt(unsigned int& a, unsigned int& b) {
	cout << "Please enter a command or valid coordinate: ";
	//for TicTacToe
	if (this->longestPiece == 1) { 
		string userinput;
		cin >> userinput;
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
			string temp = this->player1_move;
			temp += userinput.at(0);
			temp += ",";
			temp += userinput.at(2);
			temp += ";";
			this->player1_move = temp;
		}

		if (this->player == 2) { //if it's player O's turn
			string temp = this->player2_move;
			temp += userinput.at(0);
			temp += ",";
			temp += userinput.at(2);
			temp += ";";
			this->player2_move = temp;
		}

	}

	//for Gomoku
	else if(this->longestPiece==2){
		while (true) {
			string input;
			getline(cin, input);
			lowercase(input);	//change input string to all lowercase
			if (input == "quit") {
				return user_quit;
			}
			else {
				if (input.find(',') != string::npos) {	//make sure string has a comma
					for (char& c : input) {				//replace comma with a space
						if (c == ',') {
							c = ' ';
						}
					}
					istringstream iss(input);
					if (iss >> a && iss >> b) {
						//check if stream is empty; source: https://stackoverflow.com/questions/8046357/how-do-i-check-if-a-stringstream-variable-is-empty-null
						if (iss.rdbuf()->in_avail() == 0) {
							if (a >= 0 && a <= 18 && b >= 0 && b <= 18) {
								if (this->player == 1) { //if it's player X's turn
									string temp = this->player1_move;
									temp += to_string(a);
									temp += ",";
									temp += to_string(b);
									temp += ";";
									this->player1_move = temp;
								}

								if (this->player == 2) { //if it's player O's turn
									string temp = this->player2_move;
									temp += to_string(a);
									temp += ",";
									temp += to_string(b);
									temp += ";";
									this->player2_move = temp;
								}
								return prompt_success;
							}
						}
					}
				}
			}
			cout << "Please enter valid coordinate: ";
		}
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
			int index = (this->width * (x+1)) + (y+1);
			bool check = (this->gp[index] == " ");
			if (check) { //if nothing is on the coordinate
				if (this->player == 1) {
					this->gp[index] = "X";

					//print out gameboard
					cout << *this << endl;
					//blank line
					cout << " " << endl;
					//print out moves so far for that player
					cout << this->player1_move << endl;
					this->setPlayer(2); //swap turns
				}
				else if (this->player == 2) {
					this->gp[index] = "O";
					//print out gameboard
					cout << *this << endl;
					//blank line
					cout << " " << endl;
					//print out moves so far for that player
					cout << this->player2_move << endl;
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


int GomokuGame::turn() {
	unsigned int x;
	unsigned int y;
	//print out message before the turn 
	cout << "It's player " << this->player << "'s turn" << endl;
	if (this->player == 1) {
		cout << "You will use the B game piece" << endl;
	}
	else if (this->player == 2) {
		cout << "You will use the W game piece" << endl;
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
			int index = (this->width * (x + 1)) + (y + 1);
			bool check = (this->gp[index] == "  ");
			if (check) { //if nothing is on the coordinate
				if (this->player == 1) {
					this->gp[index] = "B ";
					//print out gameboard
					cout << *this << endl;
					//blank line
					cout << " " << endl;
					//print out moves so far for that player
					cout << this->player1_move << endl;
					this->setPlayer(2); //swap turns
				}
				else if (this->player == 2) {
					this->gp[index] = "W ";
					//print out gameboard
					cout << *this << endl;
					//blank line
					cout << " " << endl;
					//print out moves so far for that player
					cout << this->player2_move << endl;
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

void TicTacToeGame::print() {
	cout << *this << endl;
}

void GomokuGame::print() {
	cout << *this << endl;
}


bool TicTacToeGame::draw() {
	if (this->done()) {
		return false;
	}

	else {
		int count = 0;
		for (int i = 2; i <= height-2; ++i) { //row
			for (int j = 2; j <= width-2; ++j) {//col
				int index = this->width * j + i;
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


bool GomokuGame::draw() {
	if (this->done()) {
		return false;
	}

	else {
		int count = 0;
		for (int i = 1; i <height; ++i) { //row
			for (int j = 1; j <width; ++j) {//col
				int index = this->width * j + i;
				if (this->gp[index] != "  ") { //if string is not empty
					count++; 
				}
			}
		}
		if (count == 361) {
			return true;
		}
		else {
			return false; 
		}
	}

}

int GameBase::play() {

	//print gameboard
	this->print();
	while (true) {

		int turnResult=turn();
		bool doneResult=done();
		bool drawResult=draw();

		if (doneResult) {
			cout << this->winner << " has won the game!" << endl;
			return play_success;
		}
		if (drawResult) {
			cout << this->round-1 << " round(s) have been played and there are no moves remaining. It's a draw!" << endl;
			return play_failure_draw;
		}
		if (turnResult == turn_quit) {
			cout << this->round-1 << " round(s) have been played and one player quits. Game ended!" << endl;
			return play_failure_quit;
		}
	}
}

ostream& operator <<(ostream& out, const TicTacToeGame& g) { //define insertion operator that prints out gameboard
	
	auto row = g.height-1; //starts at the top row 
	out << "The game board: " << endl;

	for (row; row >= 0; --row) {
		for (auto col = 0; col < g.width; ++col) {
			int index = (g.width * col) + row;
			if (g.longestPiece == 1) {
				out << g.gp[index] << " ";
			}
			else if (g.longestPiece == 2) {
				out << g.gp[index] << "  ";
			}
		}
		out << endl;
	}
	return out; 
}


ostream& operator <<(ostream& out, const GomokuGame& g) { //define insertion operator that prints out gameboard

	auto row = g.height - 1; //starts at the top row 
	out << "The game board: " << endl;

	for (row; row >= 0; --row) {
		for (auto col = 0; col < g.width; ++col) {
			int index = (g.width * col) + row;
			if (g.longestPiece == 1) {
				out << g.gp[index] << " ";
			}
			else if (g.longestPiece == 2) {
				out << g.gp[index] << "  ";
			}

		}
		out << " " << endl;
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
	auto size = x_horizontal * y_vertical;
	if (gp.size() < size) {
		return wrong_size;
	}

	else {
		int row = y_vertical - 1; //starts at the top row 

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

