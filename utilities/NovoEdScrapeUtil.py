import requests

res = requests.get('https://novoed.com/courses/all.json')

# This already contains all the courses on NovoEd..
res_json = res.json()

for course in res_json['courses']:
    print course['name']
