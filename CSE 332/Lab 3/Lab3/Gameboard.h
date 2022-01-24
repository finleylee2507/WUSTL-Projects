#pragma once
#ifndef Gameboard
#define Gameboard
#include <vector>
#include <string>
#include <iostream>
#include <fstream>
#include<sstream>
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

class TicTacToeGame {

	friend ostream& operator <<(ostream& out, const TicTacToeGame& g);
public:
	TicTacToeGame(); //default constructor
	bool done();
	bool draw();
	int prompt(unsigned int& a, unsigned int& b);
	int turn();
	int play(); 
	
	//accessors
	int getHeight()const;
	int getWidth()const;
	int getPlayer()const;
	int getRound()const;
	vector<string> getGameboard()const;
	string getPlayerX_move()const;
	string getPlayerO_move()const;
	string getWinner()const;
	string getQuitter()const;



	//mutators

	void setPlayer(int newPlayer);
	void changePlayerX_move(string playerXmove);
	void changePlayerO_move(string playerYmove);
	void increaseRound();
	void setWinner(string winner);
	void setQuitter(string quitter);


private:
	vector <string> gp; //vector to hold all the gamepieces 
	int height;
	int width; 
	int player;
	int round;
	string playerX_move;
	string playerO_move;
	string winner;
	string quitter;
	

};

/*functions declaration*/

int read_gameboard(ifstream& ifs, unsigned int& x, unsigned int& y);

int read_gamepieces(ifstream& ifs, vector<Gamepieces::games_pieces>& gp, unsigned int x_horizontal, unsigned int y_vertical);

int print_out_pieces(const vector<Gamepieces::games_pieces>& gp, unsigned int x_horizontal, unsigned int y_vertical);

ostream& operator <<(ostream& out, const TicTacToeGame& g);


#endif /*Gameboard*/
