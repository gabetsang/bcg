PROBLEM
You have joined a science project as the latest team member. Scientists on the project are running a series of experiments and need to calculate the number of full days elapsed in between the experiment’s start and end dates,  i.e. the first and the last day are considered partial days and never counted. Following this logic, an experiment that has run from 07/11/1972 and 08/11/1972 should return 0, because there are no fully elapsed days contained in between those dates, and 01/01/2000 to 03/01/2000 should return 1. The solution needs to cater for all valid dates between 01/01/1901 and 31/12/2999.

As the new guy on the team, you are tasked with the job.  The scientists are using an older, command line based system and need at least one way of providing input and output on the terminal - they’re asking you to build the system accordingly. They also don’t just take your word for it when it comes to saying “I’m done”, they want proof. It turns out they have designed the job as an experiment and given you a few test cases to pass and validate the output of your program.

TEST CASES (DD/MM/YYYY)
1. 02/06/1983 - 22/06/1983: 19 days
2. 04/07/1984 - 25/12/1984: 173 days
3. 03/01/1989 - 03/08/1983: 1979 days

