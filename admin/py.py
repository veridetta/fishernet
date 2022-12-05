

# import os
# import urllib.parse

# sent_query = os.environ['QUERY_STRING']
# query_list = sent_query.split('=')
# query_dict = urllib.parse.parse_qs(os.environ['QUERY_STRING'])

# def greeter(name, surname):
#     return('Hello ' + str(name).capitalize() + ' ' + str(surname).capitalize)


# input_name = str(query_dict['name'])[2:-2]
# input_surname = str(query_dict['surname'])[2:-2]

# print("Content-Type: text/html\n")
# print(str(greeter(input_name, input_surname)))

# print("Hello World")

import sys

x = sys.argv[1]

print(x)
