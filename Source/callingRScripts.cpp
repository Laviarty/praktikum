#include <iostream>
using namespace std;


int main(){
	
	cout <<"R Script Test!"<<endl;
	//string r_command = "RScript ./table.R";
	//system("RScript ./table.R");
	int test = system("Rscript ./table.R");
	cout<<test<<endl;
	return 0;

}
