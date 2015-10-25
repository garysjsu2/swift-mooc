import feedparser

d = feedparser.parse("https://www.edx.org/api/v2/report/course-feed/rss")

print d['feed']['title']
print len(d['entries'])

i = 0
while (i < 100):
    # title
    print d['entries'][i]['title'].encode('ascii', 'ignore')
    
    # link
    print d['entries'][i]['link']

    # description
    print d['entries'][i]['description'].encode('ascii', 'ignore')

    # start
    #print d['entries'][i]['description']['course:id']

    # end
    #print d['entries'][i]['course:end']

    # self paced
    #print d['entries'][i]['course:self_paced']

    # subtitle
    #print d['entries'][i]['course:subtitle'].encode('ascii', 'ignore')

    # course instructors
    #print d['entries'][i]['course:instructors'].encode('ascii', 'ignore')

    # course image banners
    #print d['entries'][i]['course:image-banner']

    # course image thumbnail
    #print d['entries'][i]['course:image-thumbnail']

    # subject
    #print d['entries'][i]['course:subject']

    # school
    #print d['entries'][i]['course:school']

    # staff name
    #print d['entries'][i]['staff:name']

    i = i + 1
