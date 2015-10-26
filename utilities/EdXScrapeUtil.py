#reference:https://pythonhosted.org/feedparser/reference.html 

import feedparser
import MySQLdb

db = MySQLdb.connect(host="localhost", user="root", passwd="", db="moocs160")
cur = db.cursor()

rss_links = ["https://www.edx.org/api/v2/report/course-feed/rss",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=1",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=2",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=3",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=4",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=5",
             "https://www.edx.org/api/v2/report/course-feed/rss?page=6"]

for rss_link in rss_links:
    d = feedparser.parse(rss_link)
    
    i = 0
    while (i < 100):
        #.encode('ascii', 'ignore')
        entry = d.entries[i]

        if 'title' in entry:
            print entry['title'].encode('ascii', 'ignore')

        

        """
        print d.entries[i]['title'].encode('ascii', 'ignore')

        print d.entries[i]['link'].encode('ascii', 'ignore')

        print d.entries[i]['description'].encode('ascii', 'ignore')

        print d.entries[i]['course_self_paced'].encode('ascii', 'ignore')

        print d.entries[i]['course_subtitle'].encode('ascii', 'ignore')

        #add logic to get all course subjects
        print d.entries[i]['course_subject'].encode('ascii', 'ignore')

        print d.entries[i]['course_school'].encode('ascii', 'ignore') 

        #print d.entries[i]['staff_name'].encode('ascii', 'ignore')

        print d.entries[i]['staff_bio'].encode('ascii', 'ignore')

        print d.entries[i]['staff_image'].encode('ascii', 'ignore')

        print d.entries[i]['course_video-youtube'].encode('ascii', 'ignore')

        print d.entries[i]['course_image-banner'].encode('ascii', 'ignore')

        print d.entries[i]['course_image-thumbnail'].encode('ascii', 'ignore')

        print d.entries[i]['course_length'].encode('ascii', 'ignore')

        print d.entries[i]['course_prerequisites'].encode('ascii', 'ignore')
        """
        i = i + 1
