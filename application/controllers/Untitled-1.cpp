#include <Adafruit_Fingerprint.h>
#include <Wire.h>
#include <Adafruit_GFX.h>
#include <Adafruit_SSD1306.h>
#include <SoftwareSerial.h>

SoftwareSerial mySerial(2, 3);
SoftwareSerial fingerSerial(8, 9);
Adafruit_Fingerprint finger = Adafruit_Fingerprint(&fingerSerial);

void setup()
{
    Serial.begin(9600);
    mySerial.begin(9600);
}

void loop()
{
    String command, id, fromServer = "";
    while (mySerial.available() > 0)
    {
        fromServer += char(mySerial.read());
    }
    fromServer.trim();
    if (fromServer != "")
    {
        String arr[2];
        int index = 0;
        for (int i = 0; i <= fromServer.length(); i++)
        {
            char limiter = '/';
            if (fromServer[i] != limiter)
            {
                arr[index] += fromServer[i];
            }
            else
            {
                index++;
            }
        }
        if (index == 1)
        {
            command = arr[0];
            id = arr[1];
        }
    }
    Serial.println(fromServer);
    Serial.println(command);
    Serial.println(id);
    if (command == "enroll")
    {
        while (enrollfinger(id))
        {
            mySerial.println("resp=1&id=" + id);
            Serial.println("resp=1&id=" + id);
        }
        mySerial.println("resp=0&id=null");
        Serial.println("resp=0&id=" + null);
    }
    else if (command == "absent")
    {
      while(absentstudent(id){
            mySerial.println("resp=1&id=" + id);
            Serial.println("resp=1&id=" + id);
      }
    }
    else
    {
        mySerial.println("resp=0&id=null");
        Serial.println("resp=0&id=" + null);
    }
    command = "";
    id = "";
    delay(3000);
}

bool enrollfinger(String num)
{
    uint8_t id = num.toInt();
    finger.begin(57600);
    if (finger.verifyPassword())
    {
        Serial.println("Found fingerprint sensor!");
    }
    else
    {
        Serial.println("Did not find fingerprint sensor :(");
        while (1)
        {
            delay(1);
        }
    }

    if (id == 0)
        return;

    int x = -1;
    while (x != FINGERPRINT_OK)
    {
        x = finger.getImage();
        switch (x)
        {
        case FINGERPRINT_OK:
            Serial.println("Image Taken");
            break;
        case FINGERPRINT_NOFINGER:
            Serial.println("No Image");
            break;
        default:
            Serial.println("Err");
        }
    }
    x = finger.image2Tz(1);
    if (x != FINGERPRINT_OK)
        return -1;
    Serial.println("Remove Finger");
    delay(2000);
    x = 0;
    while (x != FINGERPRINT_NOFINGER)
    {
        x = finger.getImage();
    }
    x = -1;
    Serial.println("Place Finger Again");
    while (x != FINGERPRINT_OK)
    {
        x = finger.getImage();
        switch (x)
        {
        case FINGERPRINT_OK:
            Serial.println("Image Taken");
            break;
        case FINGERPRINT_NOFINGER:
            Serial.println("No Image");
            break;
        default:
            Serial.println("Err");
        }
    }
    x = finger.image2Tz(2);
    if (x != FINGERPRINT_OK)
        return -1;
    Serial.println("Creating Model");
    x = finger.createModel();
    if (x != FINGERPRINT_OK)
        return -1;
    Serial.print("Store ID : ");
    Serial.println(id);
    //    displayUserGreeting("Store ID : " + id);
    x = finger.storeModel(id);
    if (x != FINGERPRINT_OK)
        return -1;
    return true;
}

bool AbsentStudent(String num)
{
    int x = -1;
    Serial.print("Waiting for valid finger to scan");
    while (x != FINGERPRINT_OK)
    {
        x = finger.getImage();
        switch (x)
        {
        case FINGERPRINT_OK:
            Serial.println("Image Taken");
            break;
        case FINGERPRINT_NOFINGER:
            Serial.println("No Image");
            break;
        default:
            Serial.println("Err");
            break;
        }
    }
    x = finger.image2Tz();
    switch (x)
    {
    case FINGERPRINT_OK:
        Serial.println("Image Converted");
        break;
    case FINGERPRINT_IMAGEMESS:
        Serial.println("Image Mess");
        return x;
    case FINGERPRINT_INVALIDIMAGE:
        Serial.println("Invalid Images");
        return x;
    default:
        Serial.println("Unknown Err");
        return x;
    }
    x = finger.fingerSearch();
    if (x == FINGERPRINT_OK)
    {
        Serial.println("Finger Found");
    }
    else
    {
        Serial.println("Finger Not Found");
        return x;
    }
    Serial.print("Found ID #");
    Serial.print(finger.fingerID);
    Serial.print(" confidence : ");
    Serial.println(finger.confidence);
    //  displayUserGreeting("Found ID : " + finger.fingerID);
    return finger.fingerID;
}
