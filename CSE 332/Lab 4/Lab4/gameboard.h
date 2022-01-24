#pragma once
#ifndef Gameboard
#define Gameboard
#include <vector>
#include <string>
#include <iostream>
#include <fstream>
#include<sstream>
#include<memory>
#include"Gamepieces.h"
using namespace std;


/*enums*/

enum extraction_result {
	extraction_success = 0,
	error_reading_line = -1,
	error_extracting_dimensions = -2

};

enum read_gamepieces_result {
	read_success = 0,
	fail_to_find_well_formed_pieces = -1
};

enum print_gamepieces_result {
	print_success = 0,
	wrong_size = -1

};

enum prompt_labels {
	user_quit = -1,
	prompt_success = 0,
	extraction_error = 1

};

enum turn_labels {
	turn_quit=-1,
	turn_success=0,
	turn_extraction_error
};

enum play_labels {
	play_success=0,
	play_failure_draw=-1,
	play_failure_quit=-2
};


/*classes and structs */

class GameBase {

public:

	int prompt(unsigned int& a, unsigned int& b);
	int play();
	virtual void print() = 0;
	virtual bool done() = 0;
	virtual bool draw() = 0;
	virtual int turn() = 0;
	static GameBase* chooseGame(int argc, char* argv[]);

protected:
	vector <string> gp; //vector to hold all the gamepieces 
	int height=0;
	int width=0;
	int player=0;
	int round=0;
	string player1_move;
	string player2_move;
	string winner;
	string quitter;
	int longestPiece=0;
};


//derived class
class TicTacToeGame:public GameBase {

	friend ostream& operator <<(ostream& out, const TicTacToeGame& g);
public:
	TicTacToeGame(); //default constructor
	virtual bool done();
	virtual bool draw();
	virtual int turn();		
	virtual void print();

	//mutators

	void setPlayer(int newPlayer);
	void changeplayer1_move(string player1move);
	void changeplayer2_move(string player2move);
	void increaseRound();
	void setWinner(string winner);
	void setQuitter(string quitter);
};


class GomokuGame :public GameBase {
	friend ostream& operator <<(ostream& out, const GomokuGame& g);

public:
	GomokuGame(); //default constructor
	virtual bool done();
	virtual bool draw();
	virtual int turn();
	virtual void print();

	//mutators

	void setPlayer(int newPlayer);
	void changeplayer1_move(string player1move);
	void changeplayer2_move(string player2move);
	void increaseRound();
	void setWinner(string winner);
	void setQuitter(string quitter);


};

/*functions declaration*/

int read_gameboard(ifstream& ifs, unsigned int& x, unsigned int& y);

int read_gamepieces(ifstream& ifs, vector<Gamepieces::games_pieces>& gp, unsigned int x_horizontal, unsigned int y_vertical);

int print_out_pieces(const vector<Gamepieces::games_pieces>& gp, unsigned int x_horizontal, unsigned int y_vertical);

ostream& operator <<(ostream& out, const TicTacToeGame& g);

ostream& operator <<(ostream& out, const GomokuGame& g);
#endif /*Gameboard*/
