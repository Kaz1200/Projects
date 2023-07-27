import java.util.Scanner;

public class Main {
	public static int userMoney=1000;
	public static int multiply;
	public static int multiplier;
	public static void main(String[] args) {
		//declare variables and give them values
				
				char playAgain = ' ';
				char option = ' ';

				//Headline of the game
				System.out.println("~~~~~~~~~~~~~~~~~~~~~~~ Lotto 6/45 ~~~~~~~~~~~~~~~~~~~~~~~");
				System.out.println();
				
				/*Condition while that will put the game in the order that needs to run and function calling the methods. 
				 * If the user wants to confirm the game it should show the final results. 
				 * If the user doesn't want to confirm the game, the program should go to the end "Bye- Bye"
				 */
				while(playAgain!= 'N' || option == 'N'){
					Scanner scan = new Scanner(System.in);
					// calling of methods readLines() and readNumber(), define array digNumbers with the value of lines and number of columns (6).
					int lines = 1;
					System.out.println();
					//create and define and array with lines and 6 columns
					if(userMoney<10) {
			        	System.out.print("insufficient amount. \n ");
			        	scan.nextLine();
			        	System.exit(0);
			        }
					int[][] digNumbers = new int[lines][6];
					digNumbers = readNumber(digNumbers);
					
					//option = receives (call) the method confGame()	
					option = confGame();
					System.out.println();
					//condition that check if the user wants to confirm the game - answer Y
					if(option == 'Y'){
						userBetting();
						Multiplier();
					// Headline of the numbers (input from user)	
					System.out.println("~~~~~~~~~~~~~~~~~~~~~~~ Picked Number ~~~~~~~~~~~~~~~~~~~~~~~");
					//call method to print the array (digNumber that was input from user)
					printArray(digNumbers);
					System.out.println();
					//create and define array list with 6 positions
					int[] list = new int[6];	
					// Headline for the numbers drawn
					System.out.println("~~~~~~~~~~~~~~~~~~~~~~~ Number Lottery ~~~~~~~~~~~~~~~~~~~~~~~");
					//list receives (call) drawNumbers with 6 numbers (the sixth number is the bonus number)
					list = drawNumbers(6);
					System.out.println();
					System.out.println();
					// Headline for the numbers drawn
					System.out.println("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
					System.out.println("~~~~~~~~~~~~~~~~~~~~~~~ Lottery Winnings ~~~~~~~~~~~~~~~~~~~~~~~");
					System.out.println("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
					//call method displayResult ();
					displayResult(digNumbers, list);	
					System.out.println();
					
					//playagain receives (call) method playAg
					playAgain = playAg();					
					}
					//if the user doesn't confirm the game it goes back to the beginning and starts the game again.
					else{
						playAgain = 'N';
					}
				}
				System.out.println();
				//prints the goodbye message to the screen if the user doesn't want to play anymore.
				System.out.println("===================== That's a shame...Bye Bye!! ====================");
			}//end of main method
			
		 	/* method that does the draw of the random numbers, checks if there's a number already in the array and returns the value of "numbers".*/
			public static int[] drawNumbers(int number) {
				//create variables and give them values
				int[] numbers = new int[number];
				boolean yes = false;

				//condition that runs the array and generate the random numbers between 1 and 100		
				for (int j = 0 ; j < numbers.length ; j++) {
					//number receives the random number
					number = (int) (Math.random() * 45 + 1);
					//condition that runs the array and check if the random number generated is already in the array
					for(int x = 0 ; x < j ; x++){
						//if the number is already in the list, yes change to true and decrease the counter j
						if (numbers[x] == number){
							yes = true;
							j--;
						}
					}
					//condition that check if the number is not in the list - yes = false, stores the number in the position j
					if (yes == false){
						numbers[j] = number;
						System.out.print (numbers[j]);
					}	
					//condition to print an " - " between the numbers - the last one
					if(j < numbers.length - 1){
						System.out.print("  " );
					}
				}
				//return the value of numbers
				return numbers;
			}//end of method drawNumbers

			/* method that prints the array digNumbers in positions x and y, plus a "-" sign between the numbers*/
			public static void printArray(int[][] digNumbers) {
				//create variables and give them values
				int counter = 0;
				int game = 0;
				//condition that runs the array digNumbers
				for (int x = 0; x < digNumbers.length; x++){
					//second condition that check the array digNumbers in the position x
					for (int y = 0; y < digNumbers[x].length; y++) {
						//prints array digNumbers with positions x and y + a " - " between the numbers
						System.out.print(digNumbers[x][y] + "  " );
					}
					//condition that prints the numbers with a " - " between the numbers (1 before the last)
					if(x < digNumbers.length - 1){
						System.out.print("  ");
					}			
					//Prints an empty line
					System.out.println();
				}
			}//end of method printArray

			/* method that check if the number is already in the array. If yes, change the value of the flag and return the value of flag */
			public static boolean checkNumber(int[] list, int num) {
				//create variables and give them values
				int c = 0;
				boolean flag = true;
				//condition that check the whole array. If the number is already there, prints message on the screen and change flag to false.
				while (c < 6) {
					if (list[c] == num) {
						System.out.println("Number has already been entered. Please enter a new number! ");
						flag = false;
					}
					//increment counter c
					c++;
				}
				//returns the value of flag
				return flag;
			}//end of method checkNumber

			/* method that reads the input from user and checks if its a valid number in each line, returns the array digNumbers */
			public static int [][]readNumber(int [][] digNumbers) {
				///create variables and give them values
				boolean flag = true;
				int num = 0;
				int pos = 0;
				int line = 0;
				//condition that checks the whole array - 5 positions
				while(pos < digNumbers.length){
					//create and define an array with 5 positions, create variable line and give it a value
					int [] linearS = new int[6];
					line = 0;
				//Headline that prints the quantity of lines - input from user
				System.out.println("*************************** Line " + (pos + 1) +  " **************************");
					//condition that does the program to execute actions while line is smaller than 5
					while (line < 6) {
						//get the input from user and store in the variable data
						System.out.print("Please enter a number:");
						Scanner scanner = new Scanner(System.in);
						String data = scanner.nextLine();
						//try - convert the String from data to integer and stores in num
						try {
							num = new Integer(data);
							//boolean used as a flag to the method checkNumber()
							boolean yes = checkNumber(linearS, num);
							//condition that check if the number - input from user is between 1 and 45
							if ((num < 1) || (num > 45)) {
								//if number is out of range prints the error message on the screen
								System.out.println("Invalid number (1-45).");
							} 
							//otherwise - flag changes to false
							else {
								flag = false;
							}
							//array linearS receive num (line)
							linearS [line] = num;
							//array digNumbers receives num (position and line)
							digNumbers[pos][line] = num;
							//increment line
							line++;
						} 
						//catch if there's an exception. If there's an exception prints the error message on the screen
						catch (NumberFormatException e) {
							System.out.println("This is not a valid number.");
						}
					}
					//increment the position pos in 1
					pos++;
				}
				//returns the value of digNumbers
				return digNumbers;
				
			}//end of method readNumber

	
			/* method that display the result of the game and show if there was(were) a match(es) */
			public static void displayResult(int[][] list, int[] draw) {
				//create variables and give them values
				int yes = 0;
				int pos = 0;
				
				boolean flag = true;
				//prints an empty line
				System.out.println();
				//condition that runs the array list, increment pos and keep flag = true
				for (int x = 0; x < list.length; x++) {
					pos++;
					flag = true;
					//second condition that runs the array list checking the x positions - lines
					for (int y = 0; y < list[x].length; y++) {
						//third condition that runs the array list checking the positions - columns
						for (int k = 0; k < 6; k++){
							//condition that check if there's a match. If there's a match change flag to false and increment yes
							if (list[x][y] == draw[k]) {
								flag = false;
								yes++;
							}
						}
					}
					//prints if there was a match
					System.out.print(yes + (flag ? " " : "*") + " -- ");
				}
				//prints the match message and the number of match(es)
				System.out.print(" You have a " + yes + " matches");
				if(yes == 3) {
					multiply = 100*multiplier;
					userMoney=userMoney+multiply;
				}
				else if(yes == 4) {
					multiply = 1500*multiplier;
					userMoney=userMoney+multiply;
				}
				else if(yes == 5) {
					multiply = 50000*multiplier;
					userMoney=userMoney+multiply;
				}
				else if(yes == 6) {
					multiply = 9000000;
					userMoney=userMoney+multiply;
				}
				
				System.out.print("\nMoney: " + userMoney);
				System.out.print("\nPrice Multiplier: " + multiplier);
			}//end of method displayResult
			
			/* method to ask the user if wants to confirm the game, catch exceptions and returns the value of option */
			public static char confGame(){
				//create variables and give them values
				char option = ' ';
				Scanner scanner = new Scanner(System.in);
				//condition do that ask if the user wants to confirm the game, check if the input is valid and catch exceptions
				do{
					System.out.println();

					// ask user if wants to confirm the game
					System.out.print("Would you like to confirm the game? <Y>es / <N>o: ");
					//try - option receives the input from user
					try{
						option = scanner.nextLine().toUpperCase().charAt(0);
					}
					//catch if there's an exception. If there's an exception shows error message on the screen
					catch( NumberFormatException e ){
						System.out.println("Ooops !!! Something went wrong...");
					}
					//catch different exception (StringIndexOutOfBoundsException). If there's an exception shows error message on the screen
					catch( StringIndexOutOfBoundsException siob ){
						System.out.println("Ooops !!! Something went wrong...");
					}			
					//condition that check if the input is valid or not to confirm the game
					if ( option != 'N' && option != 'Y' ){
						//if not, show the error message on the screen
						System.out.println("Invalid input, Try again ... ");
					}
				} 
				//program does the "do" above while option != 'N' && option != 'Y'
				while ( option != 'N' && option != 'Y' );
				//returns the value of option
				return option;
			}//end of method confGame
			/* method to ask if the user wants to play again, catch exceptions and returns the value of playAgain */
			public static char playAg(){
				//declare variables and give them value
				char playAgain = ' ';
				Scanner scanner = new Scanner(System.in);
				//condition do that ask if the user wants to play the game again, check if the input is valid and catch exceptions
				do{
					System.out.println();

					// ask user if wants to play again 
					System.out.print("Try Again? <Y>es / <N>o: ");
					//try - playAgain recevives the input from user
					try{
						playAgain = scanner.nextLine().toUpperCase().charAt(0);
					}
					//catch if there's an exception. If there's an exception shows error message on the screen
					catch( NumberFormatException e ){
						System.out.println("Ooops !!! Something went wrong...");
					}
					//catch different exception (StringIndexOutOfBoundsException). If there's an exception shows error message on the screen
					catch( StringIndexOutOfBoundsException siob ){
						System.out.println("Ooops !!! Something went wrong...");
					}			
					//condition that checks if the input is valid or not to play again
					if ( playAgain != 'N' && playAgain != 'Y' ){
						//if not, show the error message on the screen
						System.out.println("Invalid input, Try again ... ");
					}
				} 
				//program does the "do" above while playAgain != 'N' && playAgain != 'Y'
				while ( playAgain != 'N' && playAgain != 'Y' );
				//returns the value of playAgain
				return playAgain;
			}
			public static void Multiplier(){
				Scanner scan = new Scanner(System.in);
				System.out.print("Enter Multiplier? (x2,x3,x4,x5 only): ");
				multiplier=scan.nextInt();
				 if(multiplier!=2&&multiplier!=3&&multiplier!=4&&multiplier!=5) {
			        	System.out.print("Enter only 2,3,4,5. \n ");
			        	Multiplier();
			        }
				 multiplier=multiplier;
				
			}
			public static void userBetting(){
				Scanner scan = new Scanner(System.in);
				int  betAmount;
		        System.out.print("How much will you bet?: ");
		        int userBet = scan.nextInt();
		        
		        if(userBet<10) {
		        	System.out.print("Amount should be not less than 10 try again\n ");
		        	userBetting();
		        }
		        else if(userMoney<userBet) {
		        	System.out.print("Bet should be less than total amount of Money\n ");
		        	userBetting();
		        }
		        else {
		        System.out.println("You entered " + userBet);
		        betAmount=userBet;
		        userMoney=userMoney-betAmount;
		        }
			}
		
		
	

}
