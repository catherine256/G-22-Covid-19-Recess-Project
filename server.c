#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
#include <string.h>
#include <sys/types.h> 
#include <sys/socket.h>
#include <netinet/in.h>
void dostuff(int); /* function prototype */
void error(const char *msg)
{
    perror(msg);
    exit(1);
}

int main(int argc, char *argv[])
{
     int sockfd, sock, portno, pid;
     socklen_t clilen;
     struct sockaddr_in serv_addr, cli_addr;

     if (argc < 2) {
         fprintf(stderr,"ERROR, no port provided\n");
         exit(1);
     }
     sockfd = socket(AF_INET, SOCK_STREAM, 0);
     if (sockfd < 0)
        error("ERROR opening socket");
     
     bzero((char *) &serv_addr, sizeof(serv_addr));
     portno = atoi(argv[1]);
     serv_addr.sin_family = AF_INET;
     serv_addr.sin_addr.s_addr = INADDR_ANY;
     serv_addr.sin_port = htons(portno);
     if (bind(sockfd, (struct sockaddr *) &serv_addr,
              sizeof(serv_addr)) < 0) 
              error("ERROR on binding");
     listen(sockfd,5);
     clilen = sizeof(cli_addr);
     while (1) {
         sock = accept(sockfd, 
               (struct sockaddr *) &cli_addr, &clilen);
         if (sock < 0) 
             error("ERROR on accept");
         pid = fork();
         if (pid < 0)
             error("ERROR on fork");
         if (pid == 0)  {
             close(sockfd);
             dostuff(sock);
             exit(0);
         }
         else close(sock);
     } /* end of while */
     close(sockfd);
     return 0; /* we never get here */
}
void dostuff (int sock){
system("clear");
//System variables
char buffer[255];
char file_name[255];
char patient_name[255];
char last_name[255];
char hospital_name[255];
int count;
int m;
int count_lines=0;
char gender;
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
//System header to be displayed after the clear function 
printf("*********************************************\n");
printf("COVID-19 CASE MANAGEMENT SERVER\n");
printf("*********************************************\n");
printf("Waiting for connections.............\n");
//Declaration od file pointer fp
FILE *fp;

//A function to open enrollment file
void addpatient(){
fp = fopen("enrollment_file.txt", "a");
printf("success\n");
printf("Adding patient....\n");
    }

//A function to Add one patient to the patient file
void addpatientlist(){
//Write the details to the enrollment file
fprintf(fp, "%s ", patient_name);
fprintf(fp, "%s\t", last_name);
fprintf(fp, "%c\t", gender);
fprintf(fp, "%s\t", category);
fprintf(fp, "%s\t", district);
fprintf(fp, "%s\t", username);
fprintf(fp, "%s\n", hospital_name);
printf("patient added!\n");
fclose(fp);
        }

void addOnePatient(){
    p : read(sock, choice, 255);
//Add only one patient 
     if((strcmp(choice, "Addpatient"))==0 && (!strstr(file_name, txt))){
          //Get patient_name
          read(sock, patient_name, 255);
          //Get patient_name
          read(sock, last_name, 255);
          //Get the gender of the patient
          read(sock, &gender, sizeof(char));
          //Get the patient category
          read(sock, category, 255);
         //Get the hospital_name
           read(sock, hospital_name, 255);
           //get the username
           printf("you want to add only one patient\n");
            printf("Patient Name is:%s\n", patient_name);
            printf("Patient Name is:%s\n", last_name);
            printf("Gender:%c\n", gender);
            printf("Category:%s\n", category);
            printf("Hospital:%s\n", hospital_name);
            printf("username:%s\n", username);
            addpatient();
               k : 
                  read(sock, opl, 255);
             if(strcmp(opl, "Addpatientlist")==0){
                printf("Adding patient 1.....\n");
                addpatientlist();
            }
              else {
                  printf("Wrong command\n");
                  goto k;
             }
}

}
//A function for uploading a text file with a list of patients
void addManyCases(){
read(sock, choice, 255);
printf("choice:%s\n", choice);
read(sock, file_name, 255);
printf("The file name is %s\n", file_name);
if((strcmp(choice, "Addpatient")==0) && (strstr(file_name, txt))){
printf("You selected to add a file\n");
int words;
//Write the file to the enrollment file
fp = fopen("enrollment_file.txt", "a");
read(sock, &words, sizeof(int));
read(sock, buffer, 512);
fwrite(buffer, sizeof(char), words, fp);
fclose(fp);
printf("The file was received successfully\n");
printf("success\n");
} else {
printf("Cannot add the file\n");
}
}
//A function for counting the number of cases in the enrollment file
void checkStatus(){
l : printf("Want the number of cases\n");
int ctr = 0; 
char c; 
read(sock, choice, 255);
if(strcmp(choice, "Check_status")==0){
fp = fopen("enrollment_file.txt", "r");
    if (fp == NULL)
    {
        printf("Could not open file\n");
        goto l;
    } else {
    // Extract characters from file and store in character c
    for (c = getc(fp); c != EOF; c = getc(fp)){
        if (c == '\n') // Increment count if this character is newline
            ctr = ctr + 1;
    } 
    fclose(fp);
    write(sock, &ctr, sizeof(int));
    printf(" The lines in the file are : %d \n", ctr+1);
    }
} else {
    printf("The command may not be right!! Try again\n");
    goto l;
}
}
//Searching for a specific record from the enrollment file
void search(){
    char search[10];
    char criteria[10];
    read(sock, search, 10);
    read(sock, criteria, 10);
    if(strcmp(search, "Search")==0){
    fp = fopen("enrollment_file.txt", "r");
    char store[200];
    int records = 0;
    int total_records = 0;
    while (fgets(store, 200, fp)!=NULL)
    {
        total_records++;
        if(strstr(store, criteria)){
           puts(store);
           write(sock, store, 200);
           records++;
        }
        
    }
    write(sock, &records, sizeof(int));
    if(records == 0)
      printf("No records found. Please search again\n");
    else
    {
    int i=0;
    for(i=0; i<=total_records; i++){
        if(records == i)
        {
            int get_available = records;
            get_available == 1?printf("%d record available out of %d\n", get_available, total_records)
                               :printf("%d records available out of %d\n", get_available, total_records);
        }
    }
    
}
printf("\n");
     }
     fclose(fp);
}
//Get the username from the client
read(sock, username, 255);
printf("welcome %s\n", username);
//Get the district name from the client
read(sock, district, 255);
printf("District:%s\n", district);

//Select the choice to perform
G : read(sock, &m, sizeof(int));
printf("You selected %d\n", m);

//Actions to be performed
switch(m){
case 1:
addOnePatient();
goto G;
break;
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
close(sock);
break;
      }
}

