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
G : 
printf("Enter your username:");
scanf("%s", username);
write(sockfd, username, 255);

//Get the district
printf("Name of your district:");
scanf("%s", district);
write(sockfd, district, 255);

//Scan the choice and the file_name
k : 
scanf("%s %s", choice, file_name);
write(sockfd, choice, 255);//send the choice to the server
write(sockfd, file_name, 255);//send the patient_name to the server

if((strcmp(choice, "Addpatient")==0) && (strstr(file_name, txt))){
printf("It's a file\n");
f=fopen(file_name, "r");
for(words=0; (c=getc(f))!=EOF; words++){}
write(sockfd, &words, sizeof(int));
rewind(f);
fread(buffer, sizeof(char), 512, f);
write(sockfd, buffer, 512);
printf("The file was sent successfully\n");

} else {
printf("try again!! the file could not be submited!!\n");
goto k;
}
=======
n = read(sockfd, &records, sizeof(int));
=======
printf("1.ADD ONE CASE\n");
printf("2.ADD MANY CASES\n");
printf("3.NUMBER OF CASES\n");
printf("4.SEARCH FOR RECORDS\n");
printf("5.EXIT\n");
printf("Enter your choice: ");
scanf("%d", &m);
write(sockfd, &m, sizeof(int));
//Choices and their performances
switch(m){
case 1:
      submitOneCase();
      goto G;
      break;
case 2:
      submitManyCases();
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
}

