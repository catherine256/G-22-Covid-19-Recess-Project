#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>

void error(const char *msg)
{
perror(msg);
exit(1);
}
int main(int argc, char *argv[]){
if(argc<2){
fprintf(stderr, "Port No not provideded.Program terminated\n");
exit(1);
}
int sockfd, newsockfd, portno, n;

char buffer[255];

struct sockaddr_in serv_addr, cli_addr;
socklen_t clilen;

sockfd = socket(AF_INET, SOCK_STREAM, 0);
if(sockfd<0){
error("opening the socket");
}
bzero((char * ) &serv_addr, sizeof(serv_addr));
portno = atoi(argv[1]);
serv_addr.sin_family = AF_INET;
serv_addr.sin_addr.s_addr = INADDR_ANY;
serv_addr.sin_port = htons(portno);
if(bind(sockfd, (struct sockaddr * ) &serv_addr, sizeof(serv_addr))<0)
error("Binding failed");

listen(sockfd, 5);
clilen = sizeof(cli_addr);

newsockfd = accept(sockfd, (struct sockaddr *) &cli_addr, &clilen);

if(newsockfd < 0)
error("error on accept");

char file_name[255];
char patient_name[255];
int count;
int m;
int count_lines=0;
char gender[255];
char date[255];
char category[255];
char username[255];
char choice[255];
char disrtict[255];
char txt[]=".txt";
char criteria[10];
char c;
char chr;
char opl[255];
char district[255];
int words = 0;
char store[200];
int records = 0;
int total_records = 0;

FILE *fp;

//A function to open enrollment file
void addpatient(){
fp = fopen("enrollment_file.txt", "a");
printf("success\n");
printf("Adding patient....\n");
}

//A function to Add one patient
void addpatientlist(){
//Write the details to the enrollment file
fprintf(fp, "%s\t", patient_name);
fprintf(fp, "%s\t", date);
fprintf(fp, "%s\t", gender);
fprintf(fp, "%s\t", category);
fprintf(fp, "%s\n", username);
printf("patient added!\n");
fclose(fp);
}
void addOnePatient(){
p : read(newsockfd, choice, 255);
//Add only one patient 
 if((strcmp(choice, "Addpatient"))==0 && (!strstr(file_name, txt))){
 //Get patient_name
read(newsockfd, patient_name, 255);
//Get patient_name
read(newsockfd, date, 255);
//Get the gender of the patient
read(newsockfd, gender, 255);
//Get the patient category
read(newsockfd, category, 255);
//get the username
printf("you want to add only one patient\n");
printf("Patient Name is:%s\n", patient_name);
printf("Date of Identification is:%s\n", date);
printf("Gender:%s\n", gender);
printf("Category:%s\n", category);
printf("username:%s\n", username);

addpatient();
read(newsockfd, opl, 255);
  if(strcmp(opl, "Addpatientlist")==0){
  printf("Adding patient 1.....\n");
  addpatientlist();
  }
  else 
  printf("Wrong command\n");
  goto p;
}

else
printf("command not found\n");
}
void addManyCases(){
read(newsockfd, choice, 255);
printf("choice:%s\n", choice);
read(newsockfd, file_name, 255);
printf("The file name is %s\n", file_name);
if((strcmp(choice, "Addpatient")==0) && (strstr(file_name, txt))){
printf("You selected to add a file\n");
int words;
//Write the file to the enrollment file
fp = fopen("enrollment_file.txt", "a");
read(newsockfd, &words, sizeof(int));
read(newsockfd, buffer, 512);
fwrite(buffer, sizeof(char), words, fp);
fclose(fp);
printf("The file was received successfully\n");
printf("success\n");
} else {
printf("Cannot add the file\n");
}
}
void checkStatus(){
printf("Want the number of cases");
read(newsockfd, choice, 255);
if(strcmp(choice, "Check_status")==0){
fp = fopen("enrollment_file.txt", "r");
if(fp == NULL){
puts("\nFile does not exist");
} else{
char store[200];
int num_of_cases = 0;
while(fgets(store, 100, fp)!=NULL){
num_of_cases++;
}
write(newsockfd, &num_of_cases, sizeof(int));
fclose(fp);
}
} else {
printf("Wrong command!!! Please try again\n");
}
}
void search(){
read(newsockfd, criteria, 10);
if(strcmp(criteria, "Search")==0){
fp = fopen("enrollment_file.txt", "r");
char store[200];
char search[50];
read(newsockfd, search, 50);
while(fgets(store, 100, fp)!=NULL){
total_records++;
if(strstr(store, search)!=NULL){
puts(store);
write(newsockfd, store, 200);
records++;
}

}
write(newsockfd, &records, sizeof(int));
if(records == 0){
printf("No records found\n");
} else
{
int i=0;
for(i=0; i<total_records; i++){
if(records == i){
int get_available = records;
get_available = 1?printf("%drecord available out of %d\n", get_available, total_records)
                 :printf("%drecords available out of %d\n", get_available, total_records);
}
}
}
printf("/n");
}
}
//Get the username from the client
G : read(newsockfd, username, 255);
printf("welcome %s\n", username);
//Get the district name from the client
read(newsockfd, district, 255);
printf("District:%s\n", district);

//Select the choice to perform
read(newsockfd, &m, sizeof(int));
printf("You selected %d\n", m);

//Actions to be performed
switch(m){
case 1:
addOnePatient();
goto G;
   break;
//upload a list of patients
case 2: 
addManyCases();
goto G;
break;
case 3:
checkStatus();
goto G;
break;

case 4:
search();
goto G;
break;
case 5:
goto q;
break;
}
q:
close(newsockfd);
close(sockfd);
return 0;

}

