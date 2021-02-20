#include <mysql.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
//finish_with_error function for showing the error
void finish_with_error(MYSQL *con)
{
  fprintf(stderr, "%s\n", mysql_error(con));
  mysql_close(con);
  exit(1);
}

int main(int argc, char **argv)
{
  MYSQL *con = mysql_init(NULL);//Establish the database connection

  //Check if the connection exists
  if (con == NULL)
  {
      fprintf(stderr, "%s\n", mysql_error(con));
      exit(1);
  }
//Set the database name, password, the host and the table to use
  if (mysql_real_connect(con, "127.0.0.1", "root", NULL,
          "laravel", 0, NULL, 0) == NULL)
  {
      finish_with_error(con);
  }
//A query for uploading the text file to the database
  if(mysql_query(con, "LOAD DATA INFILE '/home/edith/Documents/Recess/enrollment_file.txt' INTO TABLE cases FIELDS TERMINATED BY '\t' (patient_name,gender,category, district,username, hospital)")){
finish_with_error(con);
}   else {
int ret;
//Deletes the enrollment file after uploading it's contents
ret = remove("/home/edith/Documents/Recess/enrollment_file.txt");

   if(ret == 0) {
      printf("File deleted successfully\n");
   } else {
      printf("Error: unable to delete the file");
   }
}
//Create the file again to receive in coming requests
FILE *fp;
fp = fopen("/home/edith/Documents/Recess/enrollment_file.txt", "a+");
  mysql_close(con);
  exit(0);

}
