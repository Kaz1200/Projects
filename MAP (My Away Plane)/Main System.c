#include <stdio.h>
#include <stdlib.h>
#include <conio.h>
#include <time.h>
#include <stdbool.h>
#include <windows.h>

void booking();
void cancel();
void display_schedule();
void display_flight();
void display_log();
void clear_log();
void search_flight();
void main_menu();
void check_seats(int seats);
void line();
void yon();
void confirm();
void payment();
void display_manila();
void display_clark();
void display_cebu();
void display_davao();
void display_iloilo();
void add_ons();

struct date {
	int day;
	int month;
	int year;
};

struct classification {
	int senior_citizen;
	int adult;
	int child;
	int infant;
};

struct flight_time {
	int hour;
	int min;
};

typedef struct price {
	int budg_eco;
	int reg_eco;
	int prem_eco;
	int buss_class;
	int prem_bus;
} fee;

// Global variable total_cost for the total amount of payment
int total_cost = 0;
int temp_cost = 0;

int main () {

	main_menu();

	return 0;

}

void main_menu() {

	int choice;

	system("cls");

	// Main Menu
	printf("Choose an action\n");
	printf("[1] Book A Flight\n[2] Cancel Flight\n[3] Display Flight Schedule\n[4] Display Booked Flight\n");
	printf("[5] Display Log\n[6] Clear Log\n[7] Exit\n");
	scanf("%d", &choice);

	switch (choice) {
		case 1:
			booking();
			break;
		case 2:
			cancel();
			break;
		case 3:
			display_schedule();
			break;
		case 4:
			display_flight();
			break;
		case 5:
			display_log();
			break;
		case 6:
			clear_log();
			break;
		case 7:
			printf("Thank You! Come Again!\n");
			system("pause");
			exit(0);
			break;
		default:
			printf("Error! Please try again!\n");
			getch();
			main();
			break;
	}

}

void booking() {

	int choice, current_loc, dest_loc, seats, available_seats;
	FILE *log, *seat_log;

	// Data structs for the date of departure and return
	struct date depart;
	struct date ret;

	// Data struct for the classification of: senior citizen, adult, child, and infant
	struct classification passenger;

	// Opens the file log.txt with append attribute
	log = fopen("log.txt","a+");

	// Lists of airports in the Philippines
	char destination_list[5][20] = {"Manila","Clark","Mactan-Cebu","Davao","Iloilo"};

	line();

	// Book a Flight
	printf("Book a flight. \n");
	printf("What trip would you like? \n");

	fputs("Type of Trip: \n", log);

	book:

	// Asking the type of flight
	printf("[1] Round trip\n[2] One-way Flight\n");
	scanf("%d", &choice);

	// Writing to log.txt what type of trip
	if (choice == 1) {
		fprintf(log, "%s\n", "Round trip");
	} else if (choice == 2) {
		fprintf(log, "%s\n", "One-way Flight");
	} else {
		printf("Error!\n");
		goto book;
	}

	line();

	// Displays the lists of destinations
	printf("Here are the lists of locations: \n");
	for (int i=0; i<5; i++) {
		printf("[%d] %s\n", i+1, destination_list[i]);
	}

	line();

	repeat:

	// Flying from what destination
	printf("Where are you from? \n");
	scanf("%d", &current_loc);

	// To check the error in the input of current location
	while (current_loc < 1 || current_loc > 5) {
		printf("Error! Please try again!\n");
		goto repeat;
	}

	// Writing to log.txt the current location
	fputs("Current location: \n", log);
	fprintf(log, "%s\n", destination_list[current_loc-1]);

	repeat2:

	// Flying to what location
	printf("Where would you like to go?\n");
	scanf("%d", &dest_loc);

	// To check the error in the input of destination
	while (dest_loc < 1 || dest_loc > 5 || dest_loc == current_loc) {
		printf("Error! Please try again!\n");
		goto repeat2;
	}

	// Writing to log.txt the destination
	fputs("Destination: \n", log);
	fprintf(log, "%s\n", destination_list[dest_loc-1]);

	// List of schedule

	switch (current_loc) {
		case 1:
			display_manila();
			break;
		case 2:
			display_clark();
			break;
		case 3:
			display_cebu();
			break;
		case 4:
			display_davao();
			break;
		case 5:
			display_iloilo();
			break;
	}

	// Getting the local date and time
    time_t t = time(NULL);
    struct tm *tm = localtime(&t);

	repeat3:

	// Date of departure
	printf("Enter the date of departure: (mm dd yyyy)\n");
	scanf("%d %d %d", &depart.month, &depart.day, &depart.year);

	// To check error in the input of date of departure
	if (depart.year < tm->tm_year + 1900) {
		printf("Error! Please try again\n");
		goto repeat3;
	} else if (depart.month < tm->tm_mon + 1) {
        printf("Error! Please try again\n");
        goto repeat3;
	} else if (depart.day < tm->tm_mday) {
        printf("Error! Please try again\n");
        goto repeat3;
	} else if (depart.year > tm->tm_year + 9878) {
		printf("Error! Please try again\n");
		goto repeat3;
	}

	// To check error in the input of date of departure
	switch (depart.month) {

		// January
		case 1:
			while (depart.day < 1 || depart.day > 31) {
				printf("Error! Please try again\n");
				goto repeat3;
			}
			break;

		// February
		case 2:
			// Checking the leap year
			if (depart.year % 4 == 0) {
				while (depart.day < 1 || depart.day > 29) {
					printf("Error! Please try again\n");
					goto repeat3;
				}
			} else {
				while (depart.day < 1 || depart.day > 28) {
					printf("Error! Please try again\n");
					goto repeat3;
				}
			}
			break;

		// March
		case 3:
			while (depart.day < 1 || depart.day > 31) {
				printf("Error! Please try again\n");
				goto repeat3;
			}

		// April
		case 4:
			while (depart.day < 1 || depart.day > 30) {
				printf("Error! Please try again\n");
				goto repeat3;
			}
			break;

		// May
		case 5:
				while (depart.day < 1 || depart.day > 31) {
				printf("Error! Please try again\n");
				goto repeat;
			}

		// June
		case 6:
			while (depart.day < 1 || depart.day > 30) {
				printf("Error! Please try again\n");
				goto repeat3;
			}
			break;

		// July
		case 7:
			while (depart.day < 1 || depart.day > 31) {
				printf("Error! Please try again\n");
				goto repeat3;
			}
			break;

		// August
		case 8:
			while (depart.day < 1 || depart.day > 31) {
				printf("Error! Please try again\n");
				goto repeat3;
			}

		// September
		case 9:
			while (depart.day < 1 || depart.day > 30) {
				printf("Error! Please try again\n");
				goto repeat3;
			}
			break;

		// October
		case 10:
			while (depart.day < 1 || depart.day > 31) {
				printf("Error! Please try again\n");
				goto repeat3;
			}

		// November
		case 11:
			while (depart.day < 1 || depart.day > 30) {
				printf("Error! Please try again\n");
				goto repeat3;
			}

		// December
		case 12:
			while (depart.day < 1 || depart.day > 31) {
				printf("Error! Please try again\n");
				goto repeat3;
			}
			break;

		default:
			printf("Error! Please try again!\n");
			goto repeat3;
			break;
	}

	// If the choice is one-way flight jump seating
	if (choice == 2) {
		goto seating;
	}

	repeat4:

	// Date of return
	printf("Enter the date of return: (mm dd yyyy)\n");
	scanf("%d %d %d", &ret.month, &ret.day, &ret.year);

	while (ret.month <= depart.month && ret.day <= depart.day && ret.year <= depart.year || ret.year > tm->tm_year + 9878) {
		printf("Error! Please try again\n");
		goto repeat4;		
	}

	// To check error in the input of date of return
	switch (ret.month) {

		// January
		case 1:
			while (ret.day < 1 || ret.day > 31) {
				printf("Error! Please try again\n");
				goto repeat4;
			}
			break;

		// February
		// Checking the leap year
		case 2:
			if (ret.year % 4 == 0) {
				while (ret.day < 1 || ret.day > 29) {
					printf("Error! Please try again\n");
					goto repeat4;
					break;
				}
			} else {
				while (ret.day < 1 || ret.day > 28) {
					printf("Error! Please try again\n");
					goto repeat4;
				}
			}
			break;

		// March
		case 3:
			while (ret.day < 1 || ret.day > 31) {
				printf("Error! Please try again\n");
				goto repeat4;
			}
			break;

		// April
		case 4:
			while (ret.day < 1 || ret.day > 30) {
				printf("Error! Please try again\n");
				goto repeat4;
			}
			break;

		// May
		case 5:
				while (ret.day < 1 || ret.day > 31) {
				printf("Error! Please try again\n");
				goto repeat4;
				break;
			}

		// June
		case 6:
			while (ret.day < 1 || ret.day > 30) {
				printf("Error! Please try again\n");
				goto repeat2;
			}
			break;

		// July
		case 7:
			while (ret.day < 1 || ret.day > 31) {
				printf("Error! Please try again\n");
				goto repeat4;
			}
			break;

		// August
		case 8:
			while (ret.day < 1 || ret.day > 31) {
				printf("Error! Please try again\n");
				goto repeat4;
			}
			break;

		// September
		case 9:
			while (ret.day < 1 || ret.day > 30) {
				printf("Error! Please try again\n");
				goto repeat4;
			}
			break;

		// October
		case 10:
			while (ret.day < 1 || ret.day > 31) {
				printf("Error! Please try again\n");
				goto repeat4;
			}
			break;

		// November
		case 11:
			while (ret.day < 1 || ret.day > 30) {
				printf("Error! Please try again\n");
				goto repeat4;
			}
			break;

		// December
		case 12:
			while (ret.day < 1 || ret.day > 31) {
				printf("Error! Please try again\n");
				goto repeat4;
			}
			break;

		default:
			printf("Error! Please try again!\n");
			goto repeat4;
			break;
	}

	// Writing to log the date of departure
	fputs("Date of departure: \n", log);
	fprintf(log, "%02d %02d %d\n", depart.month, depart.day, depart.year);

	// Writing to log the date of return
	fputs("Date of return: \n", log);
	fprintf(log, "%02d %02d %d\n", ret.month, ret.day, ret.year);

	system("pause");

	line();

    seating:

	// Opening seats.txt
    seat_log = fopen("seats.txt", "r");
    fscanf(seat_log, "%d", &available_seats);

    // Displaying available seats
    printf("\nThere are %d available seats.\n", (50-available_seats));

    // Count of senior citizen, adult, child, infant
    printf("Enter the count of senior citizen (60+), adult (18-59), child (3-18), infant (under 2 yrs old)\n");
    printf("Senior Citizen: \n");
    scanf("%d", &passenger.senior_citizen);
    printf("Adult: \n");
    scanf("%d", &passenger.adult);
    printf("Child: \n");
    scanf("%d", &passenger.child);
    printf("Infant: \n");
    scanf("%d", &passenger.infant);

    // Getting the seat count
    seats = passenger.senior_citizen + passenger.adult + passenger.child + passenger.infant;

    // Writing to log.txt the count of senior citizen, adult, child, infant
    fputs("Count of senior citizen, adult, child, infant. \n", log);
    fputs("Senior Citizen: ", log);
    fprintf(log, "%d\n", passenger.senior_citizen);
    fputs("Adult: ", log);
    fprintf(log, "%d\n", passenger.adult);
    fputs("Child: ", log);
    fprintf(log, "%d\n", passenger.child);
    fputs("Infant: ", log);
    fprintf(log, "%d\n", passenger.infant);

    // Asking if the infant or child takes a seat or seats on the lap else search_flight();
    if (passenger.child > 0 || passenger.infant > 0) {

	    repeat5:

	    printf("If traveling with child/ren, pick a seating option\n");
	    printf("[1] Child seats on the lap\n[2] Child is seated next to me\n");

	    scanf("%d", &choice);

	    switch(choice) {
	    	case 1:
	    		fputs("Child seats on the lap.\n", log);
	    		seats = seats - passenger.infant;
	    		seats = seats - passenger.child;
	    		check_seats(seats);
	    		search_flight();
	    	case 2:
	    		fputs("Child is seated next to me.\n", log);
	    		check_seats(seats);
	    		search_flight();
	    	default:
	    		printf("Error try again!\n");
	    		goto repeat5;
	    }

    } else {
    	check_seats(seats);
    	search_flight();
    }


	// Writing the date and time of transaction in log.txt
    fprintf(log, "%s", asctime(tm));

	// Writing a new line in the log.txt for
	fputs("\n", log);

	// Closing the file log.txt
	fclose(log);

	// Return to main menu?
	yon();

}

void cancel() {

	printf("This function is not available yet. Please come again later! \n");
	yon();

}

void display_schedule() {

	FILE *schedule;
    char c;

    // Opening the file log.txt with r attribute
    schedule = fopen("schedule.txt","r");

    // If file is not found print error
   	if (schedule == NULL) {
        perror("Error opening file!");
	}

    // Reading the contents of the log.txt file
    while((c = fgetc(schedule)) != EOF){
        printf("%c",c);
    }

    printf("\n");

    // Closing the file log.txt
    fclose(schedule);

    // Return to main menu?
    yon();

}

void display_manila() {

	FILE *schedule;
    char c;

    // Opening the file log.txt with r attribute
    schedule = fopen("./Schedule/Manila.txt","r");

    // If file is not found print error
   	if (schedule == NULL) {
        perror("Error opening file!");
	}

    // Reading the contents of the log.txt file
    while((c = fgetc(schedule)) != EOF){
        printf("%c",c);
    }

    printf("\n");

    // Closing the file log.txt
    fclose(schedule);

}

void display_clark() {

	FILE *schedule;
    char c;

    // Opening the file log.txt with r attribute
    schedule = fopen("./Schedule/Clark.txt","r");

    // If file is not found print error
   	if (schedule == NULL) {
        perror("Error opening file!");
	}

    // Reading the contents of the log.txt file
    while((c = fgetc(schedule)) != EOF){
        printf("%c",c);
    }

    printf("\n");

    // Closing the file log.txt
    fclose(schedule);

}

void display_cebu() {

	FILE *schedule;
    char c;

    // Opening the file log.txt with r attribute
    schedule = fopen("./Schedule/Cebu.txt","r");

    // If file is not found print error
   	if (schedule == NULL) {
        perror("Error opening file!");
	}

    // Reading the contents of the log.txt file
    while((c = fgetc(schedule)) != EOF){
        printf("%c",c);
    }

    printf("\n");

    // Closing the file log.txt
    fclose(schedule);

}

void display_davao() {

	FILE *schedule;
    char c;

    // Opening the file log.txt with r attribute
    schedule = fopen("./Schedule/Davao.txt","r");

    // If file is not found print error
   	if (schedule == NULL) {
        perror("Error opening file!");
	}

    // Reading the contents of the log.txt file
    while((c = fgetc(schedule)) != EOF){
        printf("%c",c);
    }

    printf("\n");

    // Closing the file log.txt
    fclose(schedule);

}

void display_iloilo() {

	FILE *schedule;
    char c;

    // Opening the file log.txt with r attribute
    schedule = fopen("./Schedule/Iloilo.txt","r");

    // If file is not found print error
   	if (schedule == NULL) {
        perror("Error opening file!");
	}

    // Reading the contents of the log.txt file
    while((c = fgetc(schedule)) != EOF){
        printf("%c",c);
    }

    printf("\n");

    // Closing the file log.txt
    fclose(schedule);

}

void display_flight() {

	printf("This function is not available yet. Please come again later! \n");
	yon();

}

void search_flight() {

	FILE *log = fopen("log.txt", "a+");

	// Declaring struct fee price;
	fee price;

	// Lists of price for boarding a plane
	price.budg_eco = 2017;
	price.reg_eco = 2785;
	price.prem_eco = 3170;
	price.buss_class = 6704;
	price.prem_bus = 9408;

	// Variables
	int flight_price, min_weight = 10, max_weight = 35;
	struct flight_time time_choice;

	line();

	loop:

	// Asking the user for the time of departure in the schedule
	printf("Enter the time of the scheduled flight.\n");
	printf("Hour: ");
	scanf("%d", &time_choice.hour);
	printf("Minutes: ");
	scanf("%d", &time_choice.min);

	// Checking error in the input of scheduled time
	while (time_choice.hour < 0 || time_choice.hour > 23 && time_choice.min < 0 || time_choice.min > 59) {
		printf("Error! Please try again.\n");
		goto loop;
	}

	// Writing the scheduled time in log.txt
	fputs("Time of scheduled flight: ", log);
	fprintf(log, "%02d:%02d\n", time_choice.hour, time_choice.min);

	line();

	loop1:

	// Asking the fare
	printf("Select Fare Class: \n");
	printf("[1] Budget Economy - Php %d\n[2] Regular Economy - Php %d\n[3] Premium Economy - Php %d\n", price.budg_eco, price.reg_eco, price.prem_eco);
	printf("[4] Business Class - Php %d\n[5] Premium Business Class - Php %d\n", price.buss_class, price.prem_bus);
	scanf("%d", &flight_price);

	// Checking error in the input
	while (flight_price < 0 || flight_price > 5) {
		printf("Error! Try Again\n");
		goto loop1;
	}

	// Adding the price of the flight to the total cost
	switch (flight_price) {
		case 1:
			total_cost = total_cost + price.budg_eco;
			break;
		case 2:
			total_cost = total_cost + price.reg_eco;
			break;
		case 3:
			total_cost = total_cost + price.prem_eco;
			break;
		case 4:
			total_cost = total_cost + price.buss_class;
			break;
		case 5:
			total_cost = total_cost + price.prem_bus;
			break;
	}

	line();

	// Baggage
	add_ons();

	// Go to confirm function which reviews the flight booking
	confirm();

	// Closing log.txt
	fclose(log);

	yon();

}

void add_ons() {

	FILE *log = fopen("log.txt", "a+");

	int flight_choice, baggage_weight;

	loop2:

	// Selecting the type of flight
	printf("Select a package:\n");
	printf("[1] Fly Only\n[2] Fly with Baggage\n[3] Fly with Baggage + Meal\n");
	scanf("%d", &flight_choice);

	// Checking error in the input of package
	while (flight_choice < 1 || flight_choice > 3) {
		printf("Try again\n");
		goto loop2;
	}

	// Writing the type of package to log.txt
	fputs("Package: ", log);
	switch (flight_choice) {
		case 1:
			fprintf(log, "%s\n", "Fly Only");
			break;
		case 2:
			fprintf(log, "%s\n", "Fly with Baggage");
			break;
		case 3:
			fprintf(log, "%s\n", "Fly with Baggage + Meal");
			break;
	}

	line();

	loop3:

	// Selecting baggage weight
	switch (flight_choice) {
		// Fly with baggage
		case 2:
			printf("Select Option\n");
			printf("Baggage: \n");
			printf("[1] 10kg - Php 1,120\n[2] 20kg - Php 2,240\n[3] 25kg - Php 3,360\n[4] 30kg - Php 4,480\n[5] 35kg - Php 5,600\n");
			scanf("%d", &baggage_weight);

			while (baggage_weight < 1 || baggage_weight > 5) {
				printf("Error! Please try again.\n");
				goto loop3;
			}

			// Writing to log.txt
			fputs("Baggage Weight: ", log);
			fprintf(log, "%d kg\n", baggage_weight);

			break;

		// Fly with baggage + meal
		case 3:
			printf("Select Option\n");
			printf("Baggage: \n");
			printf("[1] 10kg - Php 1,120\n[2] 20kg - Php 2,240\n[3] 25kg - Php 3,360\n[4] 30kg - Php 4,480\n[5] 35kg - Php 5,600\n");
			printf("The price of meal is Php 300.\n");
			scanf("%d", &baggage_weight);

			while (baggage_weight < 1 || baggage_weight > 5) {
				printf("Error! Please try again.\n");
				goto loop3;
			}

			total_cost = total_cost + 300;

			// Writing to log.txt
			fputs("Baggage Weight: ", log);
			switch (baggage_weight) {
				case 1:
					fprintf(log, "%d kg\n", 10);
					break;
				case 2:
					fprintf(log, "%d kg\n", 20);
					break;
				case 3:
					fprintf(log, "%d kg\n", 25);
					break;
				case 4:
					fprintf(log, "%d kg\n", 30);
					break;
				case 5:
					fprintf(log, "%d kg\n", 35);
					break;
			}
			break;
	}

	switch (baggage_weight) {
		case 1:
			temp_cost = temp_cost + 1120;
			break;
		case 2:
			temp_cost = total_cost + 2240;
			break;
		case 3:
			temp_cost = temp_cost + 3360;
			break;
		case 4:
			temp_cost = temp_cost + 4480;
			break;
		case 5:
			temp_cost = temp_cost + 5600;
			break;
	}

}

void display_log() {

	FILE *log;
    char c;

    // Opening the file log.txt with r attribute
    log = fopen("log.txt","r");

    // If file is not found print error
   	if (log == NULL) {
        perror("Error opening file!");
	}

    line();

    // Reading the contents of the log.txt file
    while((c = fgetc(log)) != EOF){
        printf("%c",c);
    }

    line();

    // Closing the file log.txt
    fclose(log);

    // Return to main menu?
    yon();

}

void clear_log() {

	FILE *log;

    // Opening the file log.txt with w attribute
    log = fopen("log.txt","w");

    printf("Log cleared! \n");

    fputs("Log Emptied!\n", log);

   	// Writing the date and time of clear log in log.txt
    time_t t = time(NULL);
    struct tm *tm = localtime(&t);
    fprintf(log, "%s", asctime(tm));
    fputs("\n\n", log);

    // Closing the file log.txt
    fclose(log);

    system("pause");

    // Return to main menu?
    main_menu();

}

void check_seats(int seats) {

	int max_seats = 50, current_seats, new_seats;
	char sl_str; // seat log string

	// Creating the seats.txt file
	FILE *seat_log, *log;

	// Opening the seats.txt file with r attribute
	seat_log = fopen("seats.txt", "r");

	if (seat_log == NULL) {
		seat_log = fopen("seats.txt", "w");
		fprintf(seat_log, "%d", 0);
	}

	// Reading current seats from seats.txt
	fscanf(seat_log, "%d", &current_seats);

	// Checking if the seats are full
	if (current_seats + seats > max_seats) {
		printf("This plane is full! Please board another plane.\n");

		// Opening the log.txt
		log = fopen("log.txt", "a+");
		fputs("Transaction Error!\n", log);

		// Writing the time in log.txt
	    time_t t = time(NULL);
	    struct tm *tm = localtime(&t);
	    fprintf(log, "%s", asctime(tm));
		fputs("\n", log);

		// Closing the log.txt
		fclose(log);

		system("pause");
		system("cls");

		display_schedule();
	} else {
		fclose(seat_log);
		seat_log = fopen("seats.txt", "w");

		// Writing the new seating capacity in seats.txt
		new_seats = seats + current_seats;
		fprintf(seat_log, "%d\n", new_seats);
	}

	// Closing the file
	fclose(seat_log);

}

void yon() {

	char yesOrno;

	printf("Do you want to return to main menu? (Y/N)\n");
	scanf("%s", &yesOrno);

	if (yesOrno == 'y' || yesOrno == 'Y') {
		// Go back to main function
		system("cls");
		main();
	} else if (yesOrno == 'n' || yesOrno == 'N') {
		// Exit the program
		system("cls");
		printf("Thank You! Come Again!\n");
		system("pause");
		exit(0);
	} else {
		printf("Error!\n");
		yon();
	}

}

void confirm() {

	char yesOrno;

	printf("I have reviewed the add-ons. (Y/N)\n");
	scanf("%s", &yesOrno);

	if (yesOrno == 'y' || yesOrno == 'Y') {
		// Go payment section
		system("cls");
		payment();
	} else if (yesOrno == 'n' || yesOrno == 'N') {
		Sleep(1000);
		system("pause");
		total_cost = total_cost - temp_cost;
		add_ons();
		confirm();
	} else {
		printf("Error!\n");
		confirm();
	}

}

void payment() {

	printf("Total Price: Php %d\n", total_cost);

	printf("This function is not available yet. Please come again later! \n");
	yon();

}

void line() {

	// Print a line of *
	for (int i=0; i<50; i++) {
		printf("*");
	}
	printf("\n");

}
