import static org.junit.Assert.assertTrue;

import org.junit.After;
import org.junit.AfterClass;
import org.junit.Before;
import org.junit.BeforeClass;
import org.junit.Test;


public class JUnitHelloWorldTest {
<<<<<<< Updated upstream

=======
 
>>>>>>> Stashed changes
    @BeforeClass
    public static void beforeClass() {
        System.out.println("Before Class");
    }
<<<<<<< Updated upstream

=======
 
>>>>>>> Stashed changes
    @Before
    public void before() {
        System.out.println("Before Test Case");
    }
<<<<<<< Updated upstream

=======
 
>>>>>>> Stashed changes
    @Test
    public void isGreaterTest() {
        System.out.println("Test is Succes and completed");
        JUnitHelloWorld helloWorld = new JUnitHelloWorld();
<<<<<<< Updated upstream
        assertTrue("Num 1 is greater than Num 2", helloWorld.isGreater(1, 3));
    }

=======
        assertTrue("Num 1 is greater than Num 2", helloWorld.isGreater(4, 3));
    }
  
>>>>>>> Stashed changes
    @After
    public void after() {
        System.out.println("After Test Case");
    }
<<<<<<< Updated upstream

=======
 
>>>>>>> Stashed changes
    @AfterClass
    public static void afterClass() {
        System.out.println("After Class");
    }
<<<<<<< Updated upstream
}
=======
}
>>>>>>> Stashed changes
