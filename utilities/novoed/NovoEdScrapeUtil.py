from datetime import datetime
import requests
import MySQLdb

db = MySQLdb.connect(host="localhost", user="root", passwd="your_password",
		db="moocs160")

cur = db.cursor()

def add_course(title, short_desc, long_desc, course_link, video_link,
		start_date, course_length, course_image, category, site, course_fee,
		language, certificate, university, time_scraped):

	cur.execute("INSERT INTO course_data \
		(title, short_desc, long_desc, course_link, \
		video_link, start_date, course_length, course_image, category, \
		site, course_fee, language, certificate, university, \
		time_scraped) \
		VALUES \
		('%s', '%s', '%s', '%s', \
		'%s', '%s', %d, '%s', '%s', \
		'%s', %d, '%s', 'yes', '%s', \
		NOW())" % (title, short_desc, long_desc, course_link,
								video_link, start_date, course_length, course_image, category,
								site, course_fee, language, university))
	db.commit()	

res = requests.get('https://novoed.com/courses/all.json')

# This already contains all the courses on NovoEd..
res_json = res.json()

for course in res_json['courses']:
	title = course['name']
	short_desc = course['executive_summary']
	long_desc = course['executive_summary']
	course_link = 'https://novoed.com' + course['url'] 
	video_link = ''
	start_date = datetime.now()
	course_length = 0
	course_image = course['large_cover_photo_url']
	category = course['get_catalog_name']
	site = '' 
	course_fee = 0
	language = 'EN' 
	certificate = 'yes'
	university = course['institution_name']
	time_scraped = datetime.now()

# add the course
	add_course(title, short_desc, long_desc, course_link, video_link,
		start_date, course_length, course_image, category, site, course_fee,
		language, certificate, university, time_scraped)

