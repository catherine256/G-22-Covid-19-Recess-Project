#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <netdb.h>

void error(const char *msg)
{
perror(msg);
exit(0);
}
int main(int argc, char *argv[]){
if(argc<2){
fprintf(stderr, "Port No not provided.Program terminated\n"); //alert when port number is missing
exit(1);
}
//Socket API variables
int sockfd, newsockfd, portno, n;
struct sockaddr_in serv_addr;
struct hostent *server;

char buffer[255];

if(argc < 3){
fprintf(stderr, "Usage %s hostname port\n", argv[0]);
exit(1);
}

portno = atoi(argv[2]);
sockfd = socket(AF_INET, SOCK_STREAM, 0);
if(sockfd<0){
error("opening the socket");
}

server = gethostbyname(argv[1]);
if(server == NULL){
fprintf(stderr, "Error, no such host");
}
bzero((char *) &serv_addr, sizeof(serv_addr));
serv_addr.sin_family = AF_INET;
bcopy((char *) server->h_addr, (char *) &serv_addr.sin_addr.s_addr, server->h_length);
serv_addr.sin_port = htons(portno);
if(connect(sockfd, (struct sockaddr *) &serv_addr, sizeof(serv_addr))<0)
error("Connection Failed");

char file_name[255];//A file with a list of patients
char patient_name[255];//Specifies patient name
char date[255];//Date of case submission
char gender[255];//Specifies gender for the patient
char category[255];//Specifies whether the patient is symptomic or asymptomic
char username[255];//Health officer's username
char choice[255];//Command specification like Addpatient
char txt[]=".txt";//Extension of the file to be uploaded
char c;//for counting number of words in a enrollment file
int m;//For menu selection
char opl[255];//For addpatientlist command
char district[255];//Officer's district
int words = 0;//Initialises words variable
int count;
int num_of_cases;
FILE *f;//file f pointer

//Get the username
G : printf("Enter your username:");
scanf("%s", username);
write(sockfd, username, 255);

//Get the district
printf("Name of your district:");
scanf("%s", district);
write(sockfd, district, 255);

//Scan the choice and the file_name
void command(){
scanf("%s %s", choice, file_name);
write(sockfd, choice, 255);//send the choice to the server
write(sockfd, file_name, 255);//send the patient_name to the server
}

//A function to submit cases
void submitCases(){
printf("========SUBMIT CASES==========\n");
command();
//Run this if the name of the file is specified
if((strcmp(choice, "Addpatient")==0) && (strstr(file_name, txt))){
printf("It's a file\n");
f=fopen(file_name, "r");
for(words=0; (c=getc(f))!=EOF; words++){}
write(sockfd, &words, sizeof(int));
rewind(f);
fread(buffer, sizeof(char), 512, f);
write(sockfd, buffer, 512);
printf("The file was sent successfully\n");
} else if(strcmp(choice, "Addpatient")==0){//Run this if the Addpatient command is followed by name, date ,gender, category
scanf("%s %s %s %s", patient_name, date, gender, category);
write(sockfd, patient_name, 255);
write(sockfd, date, 255);
write(sockfd, gender, 255);
write(sockfd, category, 255);
scanf("%s", opl);
write(sockfd, opl, 255);//Addpatientlist command sent to the server
}else{ 
printf("not found\nTry again\n");
 }
 
}
//function For checking the number of cases currently in the enrollment file
void checkStatus(){
   printf("========NUMBER OF CASES===========\n");
   scanf("%s", choice);//Scan check_status command
   write(sockfd, choice, 255);
   read(sockfd, &num_of_cases, sizeof(int));//Read the number of cases from the server
   printf("+.............................+\n");
   printf("|\tThere are %d cases now\t|\n", num_of_cases);//Display the number of cases to the officer
   printf("+.............................+\n");
   printf("Proceed.......\n");
}

//search for a record
void search(){
  char search[10];//For the search command
  char criteria[10];//Search by date or name of the patient
  char store[200];//an array with all the cases
  int records;//Returns the number of records
  int get_available;
  printf("========SEARCH FOR A RECORD===========\n");
  printf("search by name or date\n");
  scanf("%s %s", search, criteria);
  write(sockfd, search, 10);
  write(sockfd, criteria, 10);

  read(sockfd, store, 200);
  n = read(sockfd, &records, sizeof(int));
  read(sockfd, &records, sizeof(int));
  printf("There are %d\n", n);

printf("%s\n", store);
printf("%s\n", store);
printf("%s\n", store);
printf("%s\n", store);
printf("%s\n", store);
printf("%s\n", store);


if(records == 0){
printf("No records found\nPlease try again\n");
}
}
printf("==========MENU================\n");
printf("1.ADD CASES\n");
printf("2.NUMBER OF CASES\n");
printf("3.SEARCH FOR RECORDS\n");
printf("4.EXIT\n");
printf("Enter your choice: ");
scanf("%d", &m);
write(sockfd, &m, sizeof(int));
//Choices and their performances
switch(m){
case 1:
      submitCases();
      goto G;
      break;
case 2:
      checkStatus();
      goto G;
      break;
case 3:
      search();
      goto G;
      break;
case 4:
     goto q;
     break;
default:
      printf("You selected a wrong choice\n");
      goto G;
      break;
}

q: 
close(sockfd);
return 0;
}

