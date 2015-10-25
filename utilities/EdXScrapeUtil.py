#reference:https://pythonhosted.org/feedparser/reference.html 

import feedparser

d = feedparser.parse("https://www.edx.org/api/v2/report/course-feed/rss")

i = 0
while (i < 100):
    #.encode('ascii', 'ignore')

    print d.entries[i]['title'].encode('ascii', 'ignore')

    print d.entries[i]['link'].encode('ascii', 'ignore')

    print d.entries[i]['description'].encode('ascii', 'ignore')

    print d.entries[i]['course_self_paced'].encode('ascii', 'ignore')

    print d.entries[i]['course_subtitle'].encode('ascii', 'ignore')

    #add logic to get all course subjects
    print d.entries[i]['course_subject'].encode('ascii', 'ignore')

    print d.entries[i]['course_school'].encode('ascii', 'ignore')

    print d.entries[i]['staff_name'].encode('ascii', 'ignore')

    print d.entries[i]['staff_bio'].encode('ascii', 'ignore')

    print d.entries[i]['staff_image'].encode('ascii', 'ignore')

    print d.entries[i]['course_video-youtube'].encode('ascii', 'ignore')

    print d.entries[i]['course_image-banner'].encode('ascii', 'ignore')

    print d.entries[i]['course_image-thumbnail'].encode('ascii', 'ignore')

    print d.entries[i]['course_length'].encode('ascii', 'ignore')

    print d.entries[i]['course_prerequisites'].encode('ascii', 'ignore')

    i = i + 1
