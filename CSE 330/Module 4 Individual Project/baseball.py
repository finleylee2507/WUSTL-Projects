import re
import operator
import sys
import os

if len(sys.argv) < 2:
    sys.exit(f"Usage: {sys.argv[0]} filename")


filename = sys.argv[1]

if not os.path.exists(filename):
    sys.exit(f"Error: File '{sys.argv[1]}' not found")


class Baseball:
    pat1 = re.compile(
        r"([A-Za-z]+\s[A-Za-z]+)\s\bbatted\b\s(\d)\s\btimes with\b\s(\d)\s\bhits\b\s\band\b\s\d\s\bruns\b")

    # method to read file and parse

    def read_file(self, filename):

        dict1 = {}
        dict2 = {}
        with open(filename) as f:
            for line in f:

                match = Baseball.pat1.match(line)
                if match is not None:
                    player = match.group(1)
                    bats = match.group(2)
                    hits = match.group(3)
                    # map each player's bats to their names
                    if player in dict1:
                        dict1[player] += int(bats)
                    else:
                        dict1[player] = int(bats)

                    # map each player's hits to their names
                    if player in dict2:
                        dict2[player] += int(hits)
                    else:
                        dict2[player] = int(hits)
            f.close()

        # calculate average
        # citation: https://stackoverflow.com/questions/15238120/keep-trailing-zeroes-in-python
        dict3 = {}
        for names in dict1:
            dict3[names] = "{:.3f}".format(dict2[names]/dict1[names]) #way to keep 3 decimal digits

        # sort dict3 by values and reverse
        # return a list of tuples
        sorted_d = sorted(dict3.items(), key=operator.itemgetter(1))
        sorted_d_reversed = sorted_d[::-1]

        # print out
        for item in sorted_d_reversed:
            print(f"{item[0]}: {item[1]}")


Baseball.read_file(Baseball, filename)
