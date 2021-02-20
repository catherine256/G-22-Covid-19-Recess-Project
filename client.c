#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <netdb.h> 

void error(const char *msg)
{
    perror(msg);
    exit(0);
}

int main(int argc, char *argv[])
{
    int sockfd, portno, n;
    struct sockaddr_in serv_addr;
    struct hostent *server;

    char buffer[256];
    if (argc < 3) {
       fprintf(stderr,"usage %s hostname port\n", argv[0]);
       exit(0);
    }
    portno = atoi(argv[2]);
    sockfd = socket(AF_INET, SOCK_STREAM, 0);
    if (sockfd < 0) 
        error("ERROR opening socket");
    server = gethostbyname(argv[1]);
    if (server == NULL) {
        fprintf(stderr,"ERROR, no such host\n");
        exit(0);
    }
    bzero((char *) &serv_addr, sizeof(serv_addr));
    serv_addr.sin_family = AF_INET;
    bcopy((char *)server->h_addr, 
         (char *)&serv_addr.sin_addr.s_addr,
         server->h_length);
    serv_addr.sin_port = htons(portno);
    if (connect(sockfd,(struct sockaddr *) &serv_addr,sizeof(serv_addr)) < 0) 
        error("ERROR connecting");
        //system variables
char file_name[255];
char patient_name[255];
char hospital_name[255];
char last_name[255];
char gender;
char category[255];
char username[255];
char choice[255];
char txt[]=".txt";
char c;
char disrtict[255];
int m;
char opl[255];
char district[255];
int words = 0;
int count;
int ctr;
FILE *f;
system("clear");
printf("\033[37m\033[41m");
printf("\t\tCOVID-19 CASE MANAGEMENT AND REPORTING SYSTEM\n");
printf("\033[0m"); 
printf("\t\t\t*****You Are Welcome********\n");
printf("---------------------------------------------------------------\n");
printf("|            \033[1;30m**SYSTEM COMMAND REFERENCE**\033[0m                  \t\t|\n");
printf("---------------------------------------------------------------\n");
printf("|     option|       command format                             |\n");
printf("---------------------------------------------------------------\n");
printf("|    [1]    |       Addpatient first_name last_name            | \n");
printf("|           |       gender category hospital_name              |  \n");
printf("|    [2]    |       Addpatient file_name                       |  \n");
printf("|    [3]    |       Check_status                               |   \n");
printf("|    [4]    |       Search criteria(name/date                  |  \n");
printf("---------------------------------------------------------------- \n");
//Get the username
printf("\t\tUsername:");
scanf("%s", username);
write(sockfd, username, 255);
//Get the district
printf("\t\tDistrict:");
scanf("%s", district);
write(sockfd, district, 255);

//A function to submit cases
void submitManyCases(){
printf("========UPLOAD A FILE WITH A LIST OF CASES==========\n");
//Scan the choice and the file_name
k : 
scanf("%s %s", choice, file_name);
write(sockfd, choice, 255);//send the choice to the server
write(sockfd, file_name, 255);//send the patient_name to the server

if((strcmp(choice, "Addpatient")==0) && (strstr(file_name, txt))){
printf("It's a file\n");
f=fopen(file_name, "r");
if(f==NULL){
printf("File can't be accessed. Try again\n");
goto k;
}
for(words=0; (c=getc(f))!=EOF; words++){}
write(sockfd, &words, sizeof(int));
rewind(f);
fread(buffer, sizeof(char), 512, f);
write(sockfd, buffer, 512);
printf("The file was sent successfully\n");
} 
else 
{
printf("try again!! the file could not be submited!!\n");
goto k;
}
}
//submit an individual patient
void submitOneCase(){
      printf("========REPORT A CASE============\n");
m : 
scanf("%s %s %s %c %s %s", choice, patient_name, last_name, &gender, category, hospital_name);
if(gender=='m'|| gender=='M'||gender=='f'||gender=='F'||(strcmp(category, "Asymptomatic")==0)||(strcmp(category, "Symptomatic")==0)){
  
} else{
 printf("......Input format may not be correct.....Please try again\n");
goto m;
}
if(strcmp(choice, "Addpatient")==0){
write(sockfd, choice, 255);
write(sockfd, patient_name, 255);
write(sockfd, last_name, 255);
write(sockfd, &gender, sizeof(char));
write(sockfd, category, 255);
write(sockfd, hospital_name, 255);
printf("    Submit the case:");
scanf("%s", opl);
if(strcmp(opl, "Addpatientlist")==0){
write(sockfd, opl, 255);
        } else{
        printf("Please try again!!!\n");
        goto m;
        }
} else {
printf("Wrong command\n");
}
 
}
//a file to Check for the number of cases in the enrollment file
void checkStatus(){
printf("========NUMBER OF CASES===========\n");
scanf("%s", choice);
write(sockfd, choice, 255);
read(sockfd, &ctr, sizeof(int));
printf("+.............................+\n");
printf("|\tNumber of cases: %d\t|\n", ctr);
printf("+.............................+\n");
}
//a function for displaying the menu
void menu(){
printf("==========MENU================\n");
printf("1.ADD ONE CASE\n");
printf("2.ADD MANY CASES\n");
printf("3.NUMBER OF CASES\n");
printf("4.SEARCH FOR RECORDS\n");
printf("5.EXIT\n");
printf("Enter your choice: ");
scanf("%d", &m);
write(sockfd, &m, sizeof(int));
}
//search for a record
void search()
{
char search[10];
char criteria[10];
int i;
char store[200];
int records=0;
printf("========SEARCH FOR A RECORD===========\n");
printf("search by name or date('Search name/date')\n");
scanf("%s %s", search, criteria);
write(sockfd, search, 10);
write(sockfd, criteria, 10);
read(sockfd, store, 200);
printf("PatientName\tGender\tCategory     District   Username HospitalName\n");
printf("---------------------------------------------------------------------------\n");
printf("%s",store);
}
G : 
menu();
//Choices and their performances
switch(m){
case 1:
      submitOneCase();
      printf("\033[1;30mCase submitted....\033[0m \n");
      sleep(5);
      goto G;
      break;
case 2:
      submitManyCases();
      sleep(5);
      goto G;
      break;
case 3:
      checkStatus();
      sleep(5);
      goto G;
      break;
case 4:
      search();
      sleep(5);
      goto G;
      break;
case 5:
      printf("You are leaving.......\n");
      sleep(5);
      goto q;
      break;
default:
      printf("You selected a wrong choice\n");
      printf("Try again\n");
      goto G;
      break;
}

q: 
close(sockfd);
}


