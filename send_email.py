from email.mime.multipart import MIMEMultipart
import mysql.connector
import smtplib
import ssl
from email import encoders
from email.mime.text import MIMEText
from email.mime.base import MIMEBase
import qrcode
import qrcode.image.svg
from PIL import Image, ImageDraw  # Replace qrcode.image.pil with PIL

# Create a QR code instance


mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="test"
)

accepted_roll_numbers = []
rejected_roll_numbers =[]
accepted_ids=[]
rejected_ids=[]

mycursor = mydb.cursor()

mycursor.execute("SELECT rollNo FROM registration WHERE status = 'accept'")

for row in mycursor.fetchall():
  accepted_roll_numbers.append(row[0])  # Access the first element (roll number)


mycursor.execute("SELECT rollNo FROM registration WHERE status = 'reject'")
for row in mycursor.fetchall():
  rejected_roll_numbers.append(row[0])  # Access the first element (roll number)

mycursor.execute("SELECT id FROM registration WHERE status = 'accept'")
for row in mycursor.fetchall():
    accepted_ids.append(row[0])

mycursor.execute("SELECT id FROM registration WHERE status = 'reject'")
for row in mycursor.fetchall():
    rejected_ids.append(row[0])


mydb.close()
    








email_sender = 'neonwave2006@gmail.com'
email_password = 'qduu bsal zfrz qyqk'

for i in range(len(accepted_roll_numbers)):

# Define email sender and receiver
    qr = qrcode.QRCode(
    version=1,
    error_correction=qrcode.constants.ERROR_CORRECT_L,
    box_size=10,
    border=4,
)

    # Add data to the QR code 
    data = "http://localhost/fetchSecurity.php?id=" + str(accepted_ids[i])
    qr.add_data(data)
    qr.make(fit=True)
    
    # Create an image from the QR code data
    img = qr.make_image(fill_color="black", back_color="white")
    img.save("qr_code.png")
    
    # Create an image from the QR code
    #img = qr.make_image(fill_color="black", back_color="white")
    #img.save("qr_code.svg")
    
    email_receiver = accepted_roll_numbers[i]+"@iitdh.ac.in"

# Set the subject and body of the email


    subject = 'Appliaction Status for leave'
    body = """
    Your Application for leave is approved.
    """
    
    em = MIMEMultipart()
    em['From'] = email_sender
    em['To'] = email_receiver
    em['Subject'] = subject
    em.attach(MIMEText(body,'plain'))

    filename="qr_code.png"

    attachment = open(filename,'rb')

    attachment_package=MIMEBase('application','octet-stream')
    attachment_package.set_payload((attachment).read())
    encoders.encode_base64(attachment_package)
    attachment_package.add_header('Content-Disposition',"attachment; filename= "+filename)
    em.attach(attachment_package)
    
    # Add SSL (layer of security)
    context = ssl.create_default_context()
    
    # Log in and send the email
    with smtplib.SMTP_SSL('smtp.gmail.com', 465, context=context) as smtp:
        smtp.login(email_sender, email_password)
        smtp.sendmail(email_sender, email_receiver, em.as_string())
   

for j in range(len(rejected_roll_numbers)):
    data = "http://localhost/fetchSecurity.php?id=" + str(rejected_ids[j])
    qr.add_data(data)
    qr.make(fit=True)
    
    # Create an image from the QR code data
    img = qr.make_image(fill_color="black", back_color="white")
    img.save("qr_code.png")
    
    # Create an image from the QR code
    #img = qr.make_image(fill_color="black", back_color="white")
    #img.save("qr_code.svg")

# Define email sender and receiver


    email_receiver = rejected_roll_numbers[j]+"@iitdh.ac.in"

# Set the subject and body of the email


    subject = 'Appliaction Status for leave'
    body = """
    Your Application for leave is rejected.
    """
    
    em=MIMEMultipart()
    em['From'] = email_sender
    em['To'] = email_receiver
    em['Subject'] = subject
    em.attach(MIMEText(body,'plain'))

    filename="qr_code.png"

    attachment = open(filename,'rb')

    attachment_package=MIMEBase('application','octet-stream')
    attachment_package.set_payload((attachment).read())
    encoders.encode_base64(attachment_package)
    attachment_package.add_header('Content-Disposition',"attachment; filename= "+filename)
    em.attach(attachment_package)
    
    # Add SSL (layer of security)
    context = ssl.create_default_context()
    
    # Log in and send the email
    with smtplib.SMTP_SSL('smtp.gmail.com', 465, context=context) as smtp:
        smtp.login(email_sender, email_password)
        smtp.sendmail(email_sender, email_receiver, em.as_string())